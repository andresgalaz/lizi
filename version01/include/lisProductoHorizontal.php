<?php
$GL_DIR = '../';
// Lee parámetros
$cTextoBusqueda = getPost('cTextoBusqueda');
$cOrdenProducto = getPost('cOrdenProducto');

// Arma Select Principal
$cSql = "SELECT pPrincipal,pAnexo01,cNombre,cDescripcion,dFecha,cMarca,cExtendido,nFactor,nValor,tModif,cAnexo01,cTipo,'0' as bNuevo,nStock FROM vPrincipal ";
if ($cTextoBusqueda != '') {
    $cSql .= " where cDescripcion like '%$cTextoBusqueda%' or cTextoDetalle like '%$cTextoBusqueda%' ";
}

if ($cOrdenProducto == 'ASC') {
    $cSql .= " order by nPrecio ASC";
}

if ($cOrdenProducto == 'DESC') {
    $cSql .= " order by nPrecio DESC";
}
// Ejecuta
if (!($result = $id_cnx->query($cSql))) {
    echo '<br/><br/><br/><br/>' . 'Invalid query: ' . mysqli_error($id_cnx) . '<br/><br/><br/><br/>';
}

// Prepara SQl para atributos, solo interesa NUEVO (por ahora)
$curAttr = $id_cnx->prepare("SELECT cAtributo FROM principal_atributo WHERE pPrincipal = ? and cAtributo = 'Nuevo'");
// Transfiera datos de la base a un arreglo
$arrPpal = array();
while ($row = $result->fetch_assoc()) {
    $curAttr->bind_param('i', $row['pPrincipal']);
    $curAttr->execute();
    $curAttr->bind_result($rowAttr);
    if ($curAttr->fetch()) {
        $row['bNuevo'] = '1';
    }
    $curAttr->free_result();
    array_push($arrPpal, $row);
}
$result->close();
// mysqli_free_result($result);
?>

<div class="container">
<div class="product-slider owl-carousel owl-theme">

<?php foreach ($arrPpal as $regPpal) {
    $imagenFront = rutaImagen($regPpal['pPrincipal'], 'principal', 0);
    $imagenBack = rutaImagen($regPpal['pPrincipal'], 'principal', 1);
    $linkDetalle = "detail.php?pPrincipal=" . $regPpal['pPrincipal'];
    ?>
    <div class="item">
    <div class="product">
        <div class="flip-container">
            <div class="flipper">
                <div class="front"><a href="<?=$linkDetalle?>"><img src="../<?=$imagenFront?>" alt="" class="img-fluid"></a></div>
                <div class="back"><a href="<?=$linkDetalle?>"><img src="../<?=$imagenBack?>" alt="" class="img-fluid"></a></div>
            </div>
        </div>
        <a href="<?=$linkDetalle?>" class="invisible"><img src="../<?=$imagenFront?>" alt="" class="img-fluid"></a>
        <div class="text">
        <h3><a href="<?=$linkDetalle?>"><?=$regPpal['cNombre']?></a></h3>
        <h3><?=$regPpal['cDescripcion']?></h3>
        <p class="price">
            <del></del>$<?=number_format($regPpal['nValor'],2,',','.')?>
        </p>
        <p class="buttons">
            <a href="detail.php" class="btn btn-outline-secondary">Ver detalle</a>
            <a href="basket.html" class="btn btn-primary en-construccion"><i class="fa fa-shopping-cart"></i>Al carrito</a>
        </p>
        </div>
        <!-- /.text-->
        <?php if ($regPpal['nStock'] > 0) {?>
        <div class="ribbon sale">
            <div class="theribbon">Stock</div>
            <div class="ribbon-background"></div>
        </div>
        <?php }?>
        <!-- /.ribbon-->
        <?php if ($regPpal['bNuevo'] != '0') {?>
        <div class="ribbon new">
            <div class="theribbon">Nuevo</div>
            <div class="ribbon-background"></div>
        </div>
        <!-- /.ribbon-->
        <!-- <div class="ribbon gift">
            <div class="theribbon">GIFT</div>
            <div class="ribbon-background"></div>
        </div> -->
        <!-- /.ribbon-->
        <?php }?>
    </div>
    </div>
<?php } // fin foreach ?>

    </div>
    <!-- /.product-slider-->
</div>
<!-- /.container-->
</div>
