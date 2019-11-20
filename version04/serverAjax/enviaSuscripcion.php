<?php
include '../../conexion.php';
mysqli_close($id_cnx);

header('content-type: application/json');

utf8mail( 'claudia.pierri@gmail.com'
    , 'Suscripción ' . getPost('email')
    , 'email   : ' . getPost('email') . "\n"
    , 'Servidor Web', 'info@liziechevarria.com', 'no-responder@liziechevarria.com');

echo json_encode(array('success' => true, 'mensaje' => 'Suscripción confirmada'));
?>