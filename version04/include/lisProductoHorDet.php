<?php
/**
 * Se usa para mostrar una visualización horicontal (o matricial) del producto
 */
?>
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
        <!--
            En la BD de CAVA esté campo no se utilizó
            <h3><?=$regPpal['cDescripcion']?></h3>
        -->
        <p class="price">
            <del></del>$<?=number_format($regPpal['nValor'], 2, ',', '.')?><br/>
            <b><?=$regPpal['cAnexo01']?></b>
        </p>
        <p class="buttons">
            <a href="<?=$linkDetalle?>" class="btn btn-outline-secondary">Ver detalle</a>
            <a href="basket.php?pPrincipal=<?=$regPpal['pPrincipal']?>" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Al carrito</a>
        </p>
    </div>
    <!-- /.text-->
    <?php if ($regPpal['nStock'] > 0) {?>
    <!-- <div class="ribbon sale">
        <div class="theribbon">Stock</div>
        <div class="ribbon-background"></div>
    </div> -->
    <?php }?>
    <!-- /.ribbon-->
    <?php if (isset($regPpal['Nuevo'])) {?>
    <div class="ribbon sale">
        <div class="theribbon">Nuevo</div>
        <div class="ribbon-background"></div>
    </div>
    <?php }?>
    <?php if (isset($regPpal['OfertasDia'])) {?>
    <div class="ribbon new">
        <div class="theribbon">Oferta</div>
        <div class="ribbon-background"></div>
    </div>
    <?php }?>
    <?php if (isset($regPpal['Descuento'])) {?>
    <div class="ribbon gift">
        <div class="theribbon">Promo</div>
        <div class="ribbon-background"></div>
    </div>
    <?php }?>
    <!-- /.ribbon-->
</div>
