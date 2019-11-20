<?php
// Prepara SQl para leer atributo OfertasDia, solo toma el primero ordenado aleatoriamente
$cSql = "SELECT atr.pPrincipal \n" .
    "  FROM principal_atributo atr \n" .
    "       INNER JOIN principal pr ON pr.pPrincipal = atr.pPrincipal \n" .
    " WHERE atr.cAtributo = 'OfertasDia' \n" .
    " AND   pr.nStock >= 0 ORDER BY RAND() LIMIT 1 ";
$pPrincipalOfertasDia = '';
if (($rsOfertasDia = $id_cnx->query($cSql))) {
    if ($fila = $rsOfertasDia->fetch_assoc()) {
        $pPrincipalOfertasDia = $fila['pPrincipal'];
    }
    $rsOfertasDia->close();
} else {
    echo "<!-- ERROR SQL : $cSql -->";
    error_log($id_cnx->error.":\n". $cSql);
}

// Prepara SQl para leer atributo ConDescuento, solo toma el primero ordenado aleatoriamente
$cSql = "SELECT atr.pPrincipal \n" .
    "  FROM principal_atributo atr \n" .
    "       INNER JOIN principal pr ON pr.pPrincipal = atr.pPrincipal \n" .
    " WHERE atr.cAtributo = 'Descuento' \n" .
    " AND   pr.nStock >= 0 ORDER BY RAND() LIMIT 1 ";
$pPrincipalConDescuento = '';
if (($rsConDescuento = $id_cnx->query($cSql))) {
    if ($fila = $rsConDescuento->fetch_assoc()) {
        $pPrincipalConDescuento = $fila['pPrincipal'];
    }
    $rsConDescuento->close();
} else {
    echo "<!-- ERROR SQL : $cSql -->";
    error_log($id_cnx->error.":\n". $cSql);
}

?>
<div id="top">
<div class="container">
    <div class="row">
    <div class="col-lg-6 offer mb-3 mb-lg-0">
    <!-- <a href="#" class='ml-1 en-construccion'>¿Quienes Somos?</a>&nbsp;&nbsp;
    <a href="#" class='ml-1 en-construccion'>Vinos</a>&nbsp;&nbsp;
    <a href="#" class='ml-1 en-construccion'>Degustaciones</a>&nbsp;&nbsp;
    <a href="#" class='ml-1 en-construccion'>Términos y Condiciones</a>&nbsp;&nbsp;
    <a href="contact.php" class='ml-1'>Contacto</a>&nbsp;&nbsp; -->
    <!-- false -> Descativado -->
<?php if (false && $pPrincipalOfertasDia != '') {?>
        <a href='<?="detail.php?pPrincipal=$pPrincipalOfertasDia"?>' class="btn btn-success btn-sm" >Ofertas</a>
<?php }?>
<?php if (false && $pPrincipalConDescuento != '') {?>
        <a href='<?="detail.php?pPrincipal=$pPrincipalConDescuento"?>' class="ml-1">Promoción</a>
<?php }?>
    </div>

    <div class="col-lg-6 text-center text-lg-right">
        <ul class="menu list-inline mb-0">
        <?php if ($pCliente == null) {?>
        <!-- 
            AGALAZ: Está descativado el login
            <li class="list-inline-item"><a href="#" data-toggle="modal" data-target="#login-modal">Ingreso</a></li>
            <li class="list-inline-item"><a href="register.php">Registro</a></li> 
        -->
        <?php } else {?>
        <li class="list-inline-item"><a href='#'><?=$cNombreUsuario?></a></li>
        <li class="list-inline-item"><a href='#'><?=$cEmailUsuario?></a></li>
        <li class="list-inline-item"><a href='.?cAccion=salir'>Salir</a></li>
        <?php }?>
        </ul>
    </div>
    </div>
</div>
<?php include 'login-form.php'?>
</div>
