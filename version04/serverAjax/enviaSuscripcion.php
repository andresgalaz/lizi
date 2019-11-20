<?php
include '../../conexion.php';
mysqli_close($id_cnx);

header('content-type: application/json');

utf8mail( 'lacavadebastiano@gmail.com'
    , 'Suscripción ' . getPost('email')
    , 'email   : ' . getPost('email') . "\n"
    , 'Servidor Web', 'lacavadebastiano@gmail.com', 'no-responder@lacavadebastiano.com.ar');

echo json_encode(array('success' => true, 'mensaje' => 'Suscripción confirmada'));
?>