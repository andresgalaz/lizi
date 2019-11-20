<?php
include_once '../conexion.php';
$operacion = jsonBase64decode ( getPost ( 'operacion' ) );
$miEmail = 'andres.galaz@snapcar.com.ar';
$oResp = new stdClass ();
$oResp->success = false;
$oResp->message = '';

if (! isset ( $operacion->email ) || $operacion->email == '')
	$oResp->message .= 'email,';
if (! isset ( $operacion->asunto ) || $operacion->asunto == '')
	$oResp->message .= 'asunto,';
if (! isset ( $operacion->mensaje ) || $operacion->mensaje == '')
	$oResp->message .= 'mensaje,';
if ($oResp->message != '') {
	$oResp->message = 'Faltan datos para evniar el Email:' . substr ( $oResp->message, 0, - 1 );
	echoJsonEncode ( $oResp );
	return;
}
// generate email and send!
$headers  = "Content-type: text/plain; charset=iso-8859-1\r\n";
$headers .= "From:" . $miEmail . "\r\n";
$headers .= "To: " . $miEmail. ", " . $operacion->email. "\r\n";
try {
	mail ( $miEmail, $operacion->asunto, $operacion->mensaje, $headers );
	$oResp->success = true;
} catch ( Exception $e ) {
	$oResp->message = $e->getMessage ();
	error_log ( "$miEmail,$operacion->asunto,$operacion->mensaje,$headers" );
}
echoJsonEncode ( $oResp );
?>
