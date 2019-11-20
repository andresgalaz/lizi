<?php
include_once '../../conexion.php';
/**
 * Lista las imagenes de la tabla asociada como operación
 */
$operacion = jsonBase64decode ( getPost ( 'operacion' ) );
if ($operacion->accion == 'list') {
	$fs = listaImagen ( $operacion->registro->{$operacion->pk}, $operacion->tabla );
	echoJsonEncode ( $fs );
} else if ($operacion->accion == 'delete') {
	unlink ( '../'.$operacion->nombreImagen );
	$operacion->success = true;
	echoJsonEncode ( $operacion );
}
?>
