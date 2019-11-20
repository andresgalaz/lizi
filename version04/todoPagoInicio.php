<?php
include '../conexion.php';
include 'include/cargaCompra.php';
mysqli_close($id_cnx);

/*
Datos cargados por cargaCompra.php
- $pCompra : Id o PK de la compra

Datos del cliente
- $cNombre             - $cApellido
- $cDireccion          - $cTelefono
- $cEmail              - $cProvincia
- $cPostal             - $pCliente : Id Cliente

Detalle de la Compra
- $nMontoTotal
- $nItemsStock : Items con stock
 */
// Limpia telefono de caracteres
$cTelefono = preg_replace("/[^0-9]/", "", $cTelefono);
$nMontoTotal = number_format($nMontoTotal, 2, ".", "");
// Id. de la operación para TODO PAGO
$operationid = $pCompra;

// SDK Todo Pago
include_once dirname(__FILE__) . "/include/vendor/autoload.php";
use TodoPago\Sdk;
include 'include/todoPagoCredenciales.php';

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function getLetraProvincia($cNombreProvincia)
{
    if ($cNombreProvincia == 'CABA') {
        return 'C';
    }
    if ($cNombreProvincia == 'Buenos Aires') {
        return 'B';
    }
    if ($cNombreProvincia == 'Catamarca') {
        return 'K';
    }
    if ($cNombreProvincia == 'Chaco') {
        return 'H';
    }
    if ($cNombreProvincia == 'Chubut') {
        return 'U';
    }
    if ($cNombreProvincia == 'Córdoba') {
        return 'X';
    }
    if ($cNombreProvincia == 'Corrientes') {
        return 'W';
    }
    if ($cNombreProvincia == 'Entre Ríos') {
        return 'E';
    }
    if ($cNombreProvincia == 'Formosa') {
        return 'P';
    }
    if ($cNombreProvincia == 'Jujuy') {
        return 'Y';
    }
    if ($cNombreProvincia == 'La Pampa') {
        return 'L';
    }
    if ($cNombreProvincia == 'La Rioja') {
        return 'F';
    }
    if ($cNombreProvincia == 'Mendoza') {
        return 'M';
    }
    if ($cNombreProvincia == 'Misiones') {
        return 'N';
    }
    if ($cNombreProvincia == 'Neuquén') {
        return 'Q';
    }
    if ($cNombreProvincia == 'Río Negro') {
        return 'R';
    }
    if ($cNombreProvincia == 'Salta') {
        return 'A';
    }
    if ($cNombreProvincia == 'San Juan') {
        return 'J';
    }
    if ($cNombreProvincia == 'San Luis') {
        return 'D';
    }
    if ($cNombreProvincia == 'Santa Cruz') {
        return 'Z';
    }
    if ($cNombreProvincia == 'Santa Fe') {
        return 'S';
    }
    if ($cNombreProvincia == 'Santiago del Estero') {
        return 'G';
    }
    if ($cNombreProvincia == 'Tierra del Fuego') {
        return 'V';
    }
    if ($cNombreProvincia == 'Tucumán') {
        return 'T';
    }
    return '';
}
$http_header = array('Authorization' => "TODOPAGO $autorizacion", 'user_agent' => 'PHPSoapClient');
$connector = new TodoPago\Sdk($http_header, $mode); // $mode: "test" para developers, "prod" para producción

//opciones para el método sendAuthorizeRequest
$optionsSAR_comercio = array(
    'Security' => $autorizacion,
    'EncodingMethod' => 'XML',
    'Merchant' => $idComercio,
    'URL_OK' => "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname($_SERVER['SCRIPT_FILENAME'])) . "/todoPagoOk.php?operationid=$operationid",
    'URL_ERROR' => "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname($_SERVER['SCRIPT_FILENAME'])) . "/todoPagoError.php?operationid=$operationid",
);
$optionsSAR_operacion = array(
    'MERCHANT' => $idComercio,
    'OPERATIONID' => "$operationid",
    'CURRENCYCODE' => $cMonedaCod,
    'AMOUNT' => $nMontoTotal,
    // PARAMETROS OPCIONALES.
    // 'MININSTALLMENTS' => 3, //Nro minimo de cuotas a mostrar en el formulario, OPCIONAL.
    // 'MAXINSTALLMENTS' => 8, //Nro maximo de cuotas a mostrar en el formulario, OPCIONAL.
    // 'AVAILABLEPAYMENTMETHODSIDS' => "1#42#500", //Filtro de Medios de Pago. OPCIONAL.
    'TIMEOUT' => 5 * 60 * 1000, //Tiempo de vida de la tansaccion. OPCIONAL.

    // Datos Cliente
    'CSBTCUSTOMERID' => $pCliente,
    'CSBTFIRSTNAME' => $cNombre, 'CSSTFIRSTNAME' => $cNombre,
    'CSBTLASTNAME' => $cApellido, 'CSSTLASTNAME' => $cApellido,
    'CSBTEMAIL' => $cEmail, 'CSSTEMAIL' => $cEmail,
    'CSBTSTREET1' => $cDireccion, 'CSSTSTREET1' => $cDireccion,
    'CSBTCITY' => $cProvincia, 'CSSTCITY' => $cProvincia,
    'CSBTCOUNTRY' => $cPais, 'CSSTCOUNTRY' => $cPais,
    'CSBTPHONENUMBER' => $cTelefono, 'CSSTPHONENUMBER' => $cTelefono,
    'CSBTPOSTALCODE' => $cPostal, 'CSSTPOSTALCODE' => $cPostal,
    'CSBTSTATE' => getLetraProvincia($cProvincia), 'CSSTSTATE' => getLetraProvincia($cProvincia),
    'CSBTIPADDRESS' => getRealIpAddr(),

    // Permite pagar sin login en Todo Pago
    'CSMDD8' => "Y",

    // Detalle de la compra
    'CSPTCURRENCY' => $cMoneda,
    'CSPTGRANDTOTALAMOUNT' => $nMontoTotal,

    // Por ahora se muestra el primer producto
    'CSITPRODUCTCODE' => $arrCompra[0]['pPrincipal'],
    'CSITPRODUCTDESCRIPTION' => $arrCompra[0]['cProducto'],
    'CSITPRODUCTNAME' => $arrCompra[0]['cProducto'],
    'CSITPRODUCTSKU' => $arrCompra[0]['pPrincipal'],
    'CSITTOTALAMOUNT' => $nMontoTotal,
    'CSITQUANTITY' => 1, // $nItemsStock,
    'CSITUNITPRICE' => $nMontoTotal,
);

// pide Request de Autorización
$arrAuthReq = $connector->sendAuthorizeRequest($optionsSAR_comercio, $optionsSAR_operacion);
if ($arrAuthReq['StatusCode'] > 0) {
    $_SESSION['cTituloMensaje'] = 'Al ingresar a "Todo Pago"';
    $_SESSION['cCodigoMensaje'] = 'Error';
    $_SESSION['cMensaje'] = $arrAuthReq['StatusMessage'];
    header("Location: mensaje.php");
} else {
    // Guarda en la sesión las variables para usarlas en todoPagoOk y todoPagoError
    $_SESSION['RequestKey'] = $arrAuthReq['RequestKey'];
    $_SESSION['PublicRequestKey'] = $arrAuthReq['PublicRequestKey'];
    header("Location: " . $arrAuthReq['URL_Request']);
}
