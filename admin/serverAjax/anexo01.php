<?php
include '../../conexion.php';
$GL_DIR = '../../';

if (isset ( $_GET ['lista'] )) {
	$operacion = new stdClass ();
	$operacion->accion = 'list';
	$operacion->tabla = 'anexo01';
	$operacion->orden = 'pAnexo01';
	echoJsonEncode ( ejecutaSql ( $operacion ) );
} else if (isset ( $_GET ['lista_imagen0'] )) {
	$operacion = jsonBase64decode ( getPost ( 'operacion' ) );
	// $operacion->accion = 'list';
	// $operacion->tabla = 'Anexo01';
	$operacion->orden = 'pAnexo01';
	// oAnexo01.filtro = {"nFiltroAmbiente":"3","nFiltroValorMin":"400000","nFiltroValorMax":"2","cFiltroZona":"1"};
	if (isset ( $operacion->filtro )) {
		$where = '1=1 ';
		if (isset ( $operacion->filtro->pAnexo01 ) && $operacion->filtro->pAnexo01 != '')
			$where .= " and pAnexo01 = {$operacion->filtro->pAnexo01} ";
		if (isset ( $operacion->filtro->cNombre ) && $operacion->filtro->cNombre != '')
			$where .= " and cNombre like '%{$operacion->filtro->cNombre}' ";
		if (isset ( $operacion->filtro->cDescripcion ) && $operacion->filtro->cDescripcion != '')
			$where .= " and cDescripcion like '%{$operacion->filtro->cDescripcion}' ";
		$operacion->where = $where;
	}
	$regs = ejecutaSql ( $operacion );
	for($i = 0; $i < count ( $regs ); $i ++)
		$regs [$i] ['imagen0'] = rutaImagen ( $regs [$i] ['pAnexo01'], 'anexo01', 0 );
	echoJsonEncode ( $regs );
} else if (isset ( $_GET ['imagenes'] )) {
	$operacion = jsonBase64decode ( getPost ( 'operacion' ) );
	if (isset ( $operacion->filtro ))
		echoJsonEncode ( listaImagen ( $operacion->filtro->pAnexo01, 'anexo01' ) );
	else
		echoJsonEncode ( listaImagen ( $operacion->registro->pAnexo01, 'anexo01' ) );
} else if (isset ( $_GET ['eliminar'] )) {
	$operacion = jsonBase64decode ( getPost ( 'operacion' ) );
	$oResp = ejecutaSql ( $operacion );
	if ($oResp->success)
		deleteImagen ( $operacion->registro->pAnexo01, 'anexo01' );
	echoJsonEncode ( $oResp );
} else if (isset ( $_GET ['grabar'] )) {
	$operacion = jsonBase64decode ( getPost ( 'operacion' ) );
	$oResp = ejecutaSql ( $operacion );
	if ($oResp->success) {
		// Mueve imágenes desde fileupdate/files a update/
		if (property_exists ( $oResp, 'lastId' ) && $oResp->lastId != 0)
			$operacion->registro->pAnexo01 = $oResp->lastId;
		rutaImagenMueve ( $operacion->registro->pAnexo01, 'anexo01' );
	}
	echoJsonEncode ( $oResp );
}
mysqli_close ( $id_cnx );
?>
