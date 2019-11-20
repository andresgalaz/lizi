<?php
$GL_DIR = '../';
// Lee parámetros
$pPrincipal = getPost('pPrincipal');
if ($pPrincipal == '') {
    $pPrincipal = 2;
}

// Arma Select
$cSql = "SELECT pPrincipal,pAnexo01,cNombre,cDescripcion,dFecha,cMarca,cExtendido,nFactor,nValor,tModif,cAnexo01,cTipo,'0' as bNuevo, nStock "
    . " FROM vPrincipal "
    . " WHERE pPrincipal = $pPrincipal ";
// Ejecuta
if (!($result = $id_cnx->query($cSql))) {
    echo '<br/><br/><br/><br/>' . 'Invalid query: ' . mysqli_error($id_cnx) . '<br/><br/><br/><br/>';
}
// Prepara$regPpal SQl para atributos, solo interesa NUEVO (por ahora)
$curAttr = $id_cnx->prepare("SELECT cAtributo FROM principal_atributo WHERE pPrincipal = ? and cAtributo = 'Nuevo'");
// Transfiera datos de la base a un registro
if ($regPpal = $result->fetch_assoc()) {
    $curAttr->bind_param('i', $row['pPrincipal']);
    $curAttr->execute();
    $curAttr->bind_result($rowAttr);
    if ($curAttr->fetch()) {
        $regPpal['bNuevo'] = '1';
    }
    $curAttr->free_result();
}
$result->close();

// Transfiera datos de la base a un objeto
$imagenFront = rutaImagen($regPpal['pPrincipal'],'principal',0);
$imagenBack = rutaImagen($regPpal['pPrincipal'],'principal',1);
$imagen3 = '';

?>

<div class="col-lg-9">
    <div id="productMain" class="row">
        <div class="col-md-6">
            <div data-slider-id="1" class="owl-carousel shop-detail-carousel">
                <div class="item"> <img src="../<?=$imagenFront?>" alt="" class="img-fluid"></div>
                <div class="item"> <img src="../<?=$imagenBack?>" alt="" class="img-fluid"></div>
                <!-- <div class="item"> <img src="../<?=$imagen3?>" alt="" class="img-fluid"></div> -->
            </div>
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
            <?php }?>
            <!-- /.ribbon-->
        </div>
        <div class="col-md-6">
            <div class="box">
                <h1 class="text-center"><?= $regPpal['cAnexo01'] ?></h1>
                <p class="goToDescription"><a href="#details" class="scroll-to">Scroll para conocerlo en profundidad.</a></p>
                <p class="price">$<?= $regPpal['nValor'] ?></p>
                <p class="text-center buttons">
                    <a href="basket.html" class="btn btn-primary en-construccion"><i class="fa fa-shopping-cart"></i> Añadir al Carrito </a>
                    <a href="basket.html" class="btn btn-outline-primary en-construccion"><i class="fa fa-heart"></i> Añadir a Favoritos</a>
                </p>
            </div>
            <div data-slider-id="1" class="owl-thumbs">
                <button class="owl-thumb-item"><img src="../<?=$imagenFront?>" alt="" class="img-fluid"></button>
                <button class="owl-thumb-item"><img src="../<?=$imagenBack?>" alt="" class="img-fluid"></button>
                <!-- <button class="owl-thumb-item"><img src="../<?=$imagen3?>" alt="" class="img-fluid"></button> -->
            </div>
        </div>
    </div>

    <div id="details" class="box">
        <p></p>
        <h4>Detalle del Producto</h4>
        <!-- <p>White lace top, woven, has a round neck, short sleeves, has knitted lining attached</p> -->
        <?= $regPpal['cDescripcion']?>
        <!-- <h4>Provincia de Origen</h4>
        <ul>
            <li>La Rioja</li>
        </ul>
        <h4>Varietal</h4>
        <ul>
            <li>Malbec</li>
        </ul> -->
        <blockquote>
            <!-- <p><em> Define style this season with Armani's new range of trendy tops,
                    crafted with intricate details. Create a chic statement look by
                    teaming this lace number with skinny jeans and pumps.</em>
            </p> -->
            <?= $regPpal['cExtendido']?>
        </blockquote>
        <hr>
        <div class="social">
            <h4>Compartir</h4>
            <p>
                <a href="#" class="external facebook en-construccion"><i class="fa fa-facebook"></i></a>
                <a href="#" class="external gplus en-construccion"><i class="fa fa-google-plus"></i></a>
                <a href="#" class="external twitter en-construccion"><i class="fa fa-twitter"></i></a>
                <a href="#" class="email en-construccion"><i class="fa fa-envelope"></i></a>
            </p>
        </div>
    </div>

    <?php include 'lisProductoHorSmall_01.php'?>
    <?php include 'lisProductoHorSmall_02.php'?>
</div>
