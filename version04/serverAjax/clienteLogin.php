<?php
include '../../conexion.php';
// version 1.0
header('content-type: application/json');

// Lee parámetros
$cEmail = getPost('cEmail');
$cPassword = getPost('cPassword');
$bOk = false;
// Select valida usuario
$ps = $id_cnx->prepare('SELECT pCliente, cNombre, cPassword FROM cliente WHERE cEmail = ?');
$ps->bind_param('s', $cEmail);
$ps->execute();
$ps->bind_result($pCliente, $cNombreUsuario, $cPasswordBD);
if ($ps->fetch()) {
    if ($cPasswordBD == $cPassword) {
        $bOk = true;
    }
}
$ps->free_result();
mysqli_close($id_cnx);

// Inicia sesion
session_start();
if ($bOk) {
    $_SESSION['pCliente'] = $pCliente;
    $_SESSION['cNombre'] = $cNombreUsuario;
    $_SESSION['cEmail'] = $cEmailUsuario;
    echo json_encode(array('success' => true, 'mensaje' => 'Ingreso de usuario OK'));
} else {
    session_destroy();
    echo json_encode(array('success' => false, 'mensaje' => 'Error en usuario o password'));
}
