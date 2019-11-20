<?php
include '../../conexion.php';
// version 1.0
header('content-type: application/json');

// Lee parámetros
$cNombreUsuario = getPost('cNombre');
$cEmailUsuario = getPost('cEmail');
$cPassword = getPost('cPassword');

// Arma Insert y ejecuta
$cSql = "INSERT INTO cliente ( cNombre, cEmail, cPassword ) value ('$cNombreUsuario', '$cEmailUsuario', '$cPassword')";
if ($id_cnx->query($cSql) === true) {
    echo json_encode(array('success' => true, 'mensaje' => 'Se ha registrado correctamente.<br/>Ya puede ingresar con su email/password'));
} else {
    if (strpos($id_cnx->error, "Duplicate entry") === 0) {
        echo json_encode(array('success' => false, 'mensaje' => 'Email ya existe'));
    } else {
        echo json_encode(array('success' => false, 'mensaje' => 'Error:<br>' . $id_cnx->error));
    }
}
mysqli_close($id_cnx);
