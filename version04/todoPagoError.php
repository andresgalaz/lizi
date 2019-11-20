<?php
include '../conexion.php';
mysqli_close($id_cnx);

// Respuesta desde TODO PAGO vía Request
$answerKey = getPost('Answer');
if ($answerKey == '') {
    $_SESSION['cTituloMensaje'] = 'Al volver de "Todo Pago"';
    $_SESSION['cCodigoMensaje'] = 'Error';
    $_SESSION['cMensaje'] = 'No vieno la respuesta desde "Todo Pago"';
    header("Location: mensaje.php");
    return;
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$RequestKey = $_SESSION['RequestKey'];
if (!isset($_SESSION['RequestKey'])) {
    $_SESSION['cTituloMensaje'] = 'Al volver de "Todo Pago"';
    $_SESSION['cCodigoMensaje'] = 'Error';
    $_SESSION['cMensaje'] = 'Sesión vencida por tiempo';
    header("Location: mensaje.php");
    return;
}

// SDK TodoPago
include_once dirname(__FILE__) . "/include/vendor/autoload.php";
include 'include/todoPagoCredenciales.php';

$http_header = array('Authorization' => "TODOPAGO $autorizacion", 'user_agent' => 'PHPSoapClient');
$connector = new TodoPago\Sdk($http_header, $mode); // $mode: "test" para developers, "prod" para producción

// opciones para el método getAuthorizeAnswer
$optionsGAA = array(
    'Security' => $autorizacion,
    'Merchant' => $idComercio,
    'RequestKey' => $RequestKey,
    'AnswerKey' => $answerKey,
);
$arrAnswer = $connector->getAuthorizeAnswer($optionsGAA);

$_SESSION['cTituloMensaje'] = 'Respuesta de "Todo Pago"';
$_SESSION['cCodigoMensaje'] = 'Error ' . $arrAnswer['StatusCode'];
$_SESSION['cMensaje'] = $arrAnswer['StatusMessage'];
header("Location: mensaje.php");
