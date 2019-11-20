<?php
// Inicia sesion, esto también se hace en el head, pero en el caso del carrito se necesita al comienzo
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Se utiliza temporalmente el ID de sesión, hasta habilitar usuarios
$pCliente = session_id();

// Parámetros del request
$pPrincipal = intval(getPost('pPrincipal'));
$nCantidad = getPost('nCantidad');
$bEliminar = (intval(getPost('eliminar')) == 1);

$bAdd = false;
if ($nCantidad == '') {
    $nCantidad = 1;
    $bAdd = true;
} else {
    $nCantidad = intval($nCantidad);
    if ($nCantidad < 0) {
        $nCantidad = 0;
    }
}
// Crea o lee registro compra
$rsCompra = $id_cnx->query("SELECT pCompra, cNombre, cApellido, cTelefono, cDireccion, cEmail, cProvincia, cPostal FROM compra WHERE tCompra IS NULL AND fCliente = '$pCliente'");
if ($fila = $rsCompra->fetch_assoc()) {
    $pCompra = $fila['pCompra'];
    $cNombre = $fila['cNombre'];
    $cApellido = $fila['cApellido'];
    $cDireccion = $fila['cDireccion'];
    $cTelefono = $fila['cTelefono'];
    $cEmail = $fila['cEmail'];
    $cProvincia = $fila['cProvincia'];
    $cPostal = $fila['cPostal'];
} else {
    $id_cnx->query("INSERT INTO compra ( fCliente ) value ('$pCliente' )");
    $pCompra = $id_cnx->insert_id;
    $cNombre = '';
    $cApellido = '';
    $cDireccion = '';
    $cTelefono = '';
    $cEmail = '';
    $cProvincia = 'CABA';
    $cPostal = '';
}
$rsCompra->close();

if ($pPrincipal > 0) {
    // Inserta o Actualiza tabla compra

    if ($bEliminar) {
        $cSql = "DELETE FROM compraDet WHERE pCompra = '$pCompra' and fPrincipal = $pPrincipal";
    } else {
        $rsStock = $id_cnx->query("SELECT 'x' FROM compraDet WHERE pCompra = '$pCompra' and fPrincipal = $pPrincipal");
        if ($rsStock->num_rows > 0) {
            // Si ya existe incrementa el monto, acutliza dependiendo su vino o no el parámetro cantidad
            if ($bAdd) {
                $cSql = "UPDATE compraDet SET nCantidad = nCantidad + 1 ";
            } else {
                $cSql = "UPDATE compraDet SET nCantidad = $nCantidad ";
            }
            $cSql .= " WHERE pCompra = '$pCompra' and fPrincipal = $pPrincipal";
        } else {
            $cSql = "INSERT INTO compraDet ( pCompra, fPrincipal, nCantidad ) value ('$pCompra', $pPrincipal, $nCantidad )";
        }
        $rsStock->close();
    }
    // Ins o Upd tabla compra
    if ($id_cnx->query($cSql) === false) {
        die("Error en la conexión de la base de datos <!-- " . $id_cnx->error . " -->");
    }
    $id_cnx->commit();
}

$cSql = "SELECT pCompra, fCliente, pPrincipal, nCantidad, nDescuento, tCreacion, cProducto, nValor, nStock FROM vCompra WHERE tCompra IS NULL AND fCliente = '$pCliente'";
$rsCompraDet = $id_cnx->query($cSql);
$arrCompra = array();
$nItemsCarro = 0;
$nItemsStock = 0;
$nTotalUnidades = 0;
$nSubTotal = 0;

// Pasa un mensaje a basket.js, de los productos que no tienen Stock
$cMensajeNoStock = '';
// Transfiera datos de la base a un arreglo
while ($fila = $rsCompraDet->fetch_assoc()) {
    $nItemsCarro++;
    // Ajusta la cantidad al Sotck
    if ($fila['nCantidad'] > $fila['nStock']) {
        $fila['nCantidad'] = $fila['nStock'];
        if ($fila['nStock'] <= 0) {
            $cMensajeNoStock .= '<li>' . $fila['cProducto'] . '</li>';
        } else {
            $nItemsStock++;
        }
    }
    $nTotalUnidades += $fila['nCantidad'];
    // Se divide y multiplica por 100 para dejar 2 decimales
    $nSubTotal += round($fila['nCantidad'] * $fila['nValor'] * 100.0) / 100.0;
    array_push($arrCompra, $fila);
}
$rsCompraDet->close();

// Calcula costo envío
$nCostoEnvioUnit = 0;
if ($nTotalUnidades > 0) {
    $rsCostoEnvio = $id_cnx->query("SELECT nCosto FROM costoEnvio WHERE pCantidad = $nTotalUnidades ");
    if ($fila = $rsCostoEnvio->fetch_assoc()) {
        $nCostoEnvioUnit = $fila['nCosto'];
    }
    $rsCostoEnvio->close();
}

// Calcula Monto final
$nCostoEnvio = 0;
$nCostoEnvio = round($nCostoEnvioUnit * $nTotalUnidades * 100) / 100;
$nCalcDescuento = $nCostoEnvio / $nSubTotal * 100;
if ($nCalcDescuento <= 10) {
    // 100%  de descuento
    $nCostoEnvio = 0;
} elseif ($nCalcDescuento <= 20) {
    $nCostoEnvio *= 50 / 100;
} elseif ($nCalcDescuento <= 40) {
    $nCostoEnvio *= 75 / 100;
}

$nMontoTotal = round(($nSubTotal + $nCostoEnvio) * 100) / 100;
