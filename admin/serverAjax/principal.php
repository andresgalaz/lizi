<?php
include '../../conexion.php';
$GL_DIR = '../../';

if (isset ( $_GET ['lista'] )) {
	$operacion = new stdClass ();
	$operacion->accion = 'list';
	$operacion->tabla = 'vPrincipal';
	$operacion->orden = 'pPrincipal';
	echoJsonEncode ( ejecutaSql ( $operacion ) );
} else if (isset ( $_GET ['lista_imagen0'] )) {
	$operacion = jsonBase64decode ( getPost ( 'operacion' ) );
	$operacion->orden = 'pPrincipal';

	if (isset ( $operacion->filtro )) {
		$where = '1=1 ';
		if (isset ( $operacion->filtro->nFiltroValorMin ) && $operacion->filtro->nFiltroValorMin != '')
			$where .= " and nValor >= {$operacion->filtro->nFiltroValorMin} ";
		if (isset ( $operacion->filtro->nFiltroValorMax ) && $operacion->filtro->nFiltroValorMax != '')
			$where .= " and nValor <= {$operacion->filtro->nFiltroValorMax} ";
		if (isset ( $operacion->filtro->pAnexo01 ) && $operacion->filtro->pAnexo01 != '')
			$where .= " and pAnexo01 = {$operacion->filtro->pAnexo01} ";
		$operacion->where = $where;
	}
	$regs = ejecutaSql ( $operacion );
	for($i = 0; $i < count ( $regs ); $i ++)
		$regs [$i] ['imagen0'] = rutaImagen ( $regs [$i] ['pPrincipal'], 'principal', 0 );
	echoJsonEncode ( $regs );
} else if (isset ( $_GET ['imagenes'] )) {
	$operacion = jsonBase64decode ( getPost ( 'operacion' ) );
	if (isset ( $operacion->filtro ))
		echoJsonEncode ( listaImagen ( $operacion->filtro->pPrincipal, 'principal' ) );
	else
		echoJsonEncode ( listaImagen ( $operacion->registro->pPrincipal, 'principal' ) );
} else if (isset ( $_GET ['eliminar'] )) {
	$operacion = jsonBase64decode ( getPost ( 'operacion' ) );
	$oResp = ejecutaSql ( $operacion );
	if ($oResp->success)
		deleteImagen ( $operacion->registro->pPrincipal, 'principal' );
	echoJsonEncode ( $oResp );
} else if (isset ( $_GET ['atributos'] )) {
	$operacion = jsonBase64decode ( getPost ( 'operacion' ) );
	$attrib = new stdClass ();
	$attrib->accion = 'list';
	$attrib->tabla = 'principal_atributo';
	$attrib->where = 'pPrincipal='.$operacion->registro->pPrincipal;
	echoJsonEncode ( ejecutaSql ( $attrib ) );
} else if (isset ( $_GET ['grabar'] )) {
	$operacion = jsonBase64decode ( getPost ( 'operacion' ) );
	$atributo = $operacion->registro->atributo;
	unset($operacion->registro->atributo);
	// bHabilitado es tratado como un array desde del form. Se saca el array si tiene un solo elemento
	if(! isset($operacion->registro->bHabilitado))	
		$operacion->registro->bHabilitado = '0';
	elseif(count($operacion->registro->bHabilitado) == 1)	
		$operacion->registro->bHabilitado = $operacion->registro->bHabilitado[0];
	$oResp = ejecutaSql ( $operacion );

	if ($oResp->success) {
		// Mueve imágenes desde fileupdate/files a update/
		if (property_exists ( $oResp, 'lastId' ) && $oResp->lastId != 0)
			$operacion->registro->pPrincipal = $oResp->lastId;
		rutaImagenMueve ( $operacion->registro->pPrincipal, 'principal' );
		// Actualiza principal_atributo
		mysqli_query($id_cnx, 'DELETE FROM principal_atributo WHERE pPrincipal='.$operacion->registro->pPrincipal);
		foreach ( $atributo as $valor )
			mysqli_query($id_cnx, "INSERT INTO principal_atributo ( pPrincipal, cAtributo ) values (".$operacion->registro->pPrincipal.",'".$valor."')");
	}
	echoJsonEncode ( $oResp );
}
mysqli_close ( $id_cnx );
?>
