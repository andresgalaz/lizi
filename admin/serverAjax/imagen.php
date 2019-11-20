<?php
include_once '../../conexion.php';
/**
 * Lista las imagenes de la tabla asociada como operación
 */
$operacion = jsonBase64decode(getPost('operacion'));
error_log(print_r($operacion, true));
if ($operacion->accion == 'list') {
	$fs = listaImagen($operacion->registro->{$operacion->pk}, $operacion->tabla);
	echoJsonEncode($fs);
} else if ($operacion->accion == 'delete') {
	$nombreImgClean = explode("?", $operacion->nombreImagen);
	unlink('../' . $nombreImgClean[0]);
	$operacion->success = true;
	echoJsonEncode($operacion);
}
