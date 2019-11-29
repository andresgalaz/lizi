<?php
// version 1.0
header('content-type: application/json');

if (isset ( $_POST ['texto'] )){
	$msg = $_POST ['texto'];

	mail( "info@liziechevarria.com"
		, "Avisame"
		, "mensaje: " . $msg . " ."
		, "From: info@liziechevarria.com"
		);
	echo json_encode(array('mensaje' => 'Notificación enviada'));
} else {
	echo json_encode(array('mensaje' => 'Debe indicar email'));
}
?>
