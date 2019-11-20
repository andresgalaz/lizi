<?php
include '../conexion.php';

// Respuesta desde TODO PAGO vía Request
$answerKey = getPost('Answer');

// Recupera KEY de la sesión guardada en todoPagoInicio.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$RequestKey = $_SESSION['RequestKey'];

// Actualiza compra actual y la deja OK
$pCliente = session_id();
$id_cnx->query("UPDATE compra SET tCompra = now() WHERE tCompra IS NOT NULL AND fCliente = '$pCliente' ");
mysqli_close($id_cnx);

// Cambia session ID por si se desea hacer otra compra
session_regenerate_id(true);

// Envía respuesta
if ($answerKey == '') {
    $_SESSION['cTituloMensaje'] = 'Al volver de "Todo Pago"';
    $_SESSION['cCodigoMensaje'] = 'Pagado';
    $_SESSION['cMensaje'] = 'No hubo respuesta desde "Todo Pago",<br/> sin embargo la transacción se asume OK.';
    header("Location: mensaje.php");
    return;
}
if (!isset($_SESSION['RequestKey'])) {
    $_SESSION['cTituloMensaje'] = 'Al volver de "Todo Pago"';
    $_SESSION['cCodigoMensaje'] = 'Pagado';
    $_SESSION['cMensaje'] = 'No hay respuesta porque la sesión esta vencida por tiempo,<br/> sin embargo la transacción se asume OK.';
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
$_SESSION['cCodigoMensaje'] = 'OK';
$_SESSION['cMensaje'] = $arrAnswer['StatusMessage'];
header("Location: mensaje.php");
