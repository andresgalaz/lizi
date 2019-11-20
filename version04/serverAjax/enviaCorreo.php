<?php
include '../../conexion.php';
mysqli_close($id_cnx);

header('content-type: application/json');

$mensaje =
'email   : ' . getPost('email') . "\n" .
'nombre  : ' . getPost('firstname') . ' ' . getPost('lastname') . "\n" .
'mensaje : ' . "\n" . getPost('message');

utf8mail('lacavadebastiano@gmail.com'
    , getPost('subject', 'Sin Asunto')
    , $mensaje
    , 'Servidor Web', 'lacavadebastiano@gmail.com', 'no-responder@lacavadebastiano.com.ar');

echo json_encode(array('success' => true, 'mensaje' => 'Notificación enviada'));
?>