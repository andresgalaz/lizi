<?php
include_once '../../conexion.php';
/**
 * Recibe y ejecuta una operación de bases de datos: elimina, inserta, actualiza y lista.
 */
$operacion = jsonBase64decode ( getPost ( 'operacion' ) );
$oResp = ejecutaSql ( $operacion );
echoJsonEncode ( $oResp );
?>
