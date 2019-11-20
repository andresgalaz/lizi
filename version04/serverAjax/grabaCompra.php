<?php
include '../../conexion.php';
// version 1.0
header('content-type: application/json');

// Inicia sesion, esto también se hace en el head, pero en el caso del carrito se necesita al comienzo
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Se utiliza temporalmente el ID de sesión, hasta habilitar usuarios
$pCliente = session_id();

// Parámetros del request
$cNombre = getPost('cNombre');
$cApellido = getPost('cApellido');
$cDireccion = getPost('cDireccion');
$cProvincia = getPost('cProvincia');
$cPostal = getPost('cPostal');
$cEmail = getPost('cEmail');
$cTelefono = getPost('cTelefono');

$rsExisteCompra = $id_cnx->query("SELECT 'x' as nada FROM compra WHERE tCompra IS NULL AND fCliente = '$pCliente' ");
if ($rsExisteCompra->fetch_assoc()) {
    $id_cnx->query("UPDATE compra SET cNombre = '$cNombre', cApellido = '$cApellido'  " .
        ", cDireccion = '$cDireccion', cProvincia = '$cProvincia', cPostal = '$cPostal' " .
        ", cEmail = '$cEmail', cTelefono = '$cTelefono' " .
        " WHERE fCliente = '$pCliente' ");
} else {
    $id_cnx->query("INSERT INTO compra ( fCliente, cNombre, cApellido, cDireccion, cProvincia, cPostal, cEmail, cTelefono ) "
        . " VALUE ( '$fCliente', '$cNombre', '$cApellido', '$cDireccion', '$cProvincia', '$cPostal', '$cEmail', '$cTelefono' )");
    $pCompra = $id_cnx->insert_id;
}
$rsExisteCompra->close();
echo json_encode(array('success' => true, 'mensaje' => 'Transacción OK'));
