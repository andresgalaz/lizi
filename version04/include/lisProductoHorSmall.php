<?php
// Arma Select Principal
$cSql = "SELECT pPrincipal,pAnexo01,cNombre,cDescripcion,dFecha,cMarca,cExtendido,nFactor,nValor,tModif,cAnexo01,cTipo,'0' as bNuevo,nStock FROM vPrincipal WHERE bHabilitado='1' ORDER BY RAND() LIMIT 3";
// Ejecuta
if (!($result = $id_cnx->query($cSql))) {
    echo '<br/><br/><br/><br/>' . 'Invalid query: ' . mysqli_error($id_cnx) . '<br/><br/><br/><br/>';
}
// Transfiera datos de la base a un arreglo
$arrPpal = array();
while ($row = $result->fetch_assoc()) {
    array_push($arrPpal, $row);
}
$result->close();
?>


<div class="row same-height-row">
    <div class="col-lg-3 col-md-6">
        <div class="box same-height">
        <h3><?=$cTitulo?></h3>
        </div>
    </div>

    <?php 
    // Indica la ruta relativa donde debería estar el direcotiorio 'upload' ver función rutaImagen
    $GL_DIR = '../';

    foreach ($arrPpal as $regPpal) {
        $imagenFront = rutaImagen($regPpal['pPrincipal'], 'principal', 0);
        $imagenBack = rutaImagen($regPpal['pPrincipal'], 'principal', 1);
        $linkDetalle = "detail.php?pPrincipal=" . $regPpal['pPrincipal'];
    ?>
    <div class="col-lg-3 col-md-6">
        <div class="product same-height">
            <div class="flip-container">
                <div class="flipper">
                    <div class="front"><a href="<?=$linkDetalle?>"><img src="../<?=$imagenFront?>" alt="" class="img-fluid"></a></div>
                    <div class="back" ><a href="<?=$linkDetalle?>"><img src="../<?=$imagenBack?>"  alt="" class="img-fluid"></a></div>
                </div>
            </div>          
            <a href="<?=$linkDetalle?>" class="invisible"><img src="../<?=$imagenBack?>" alt="" class="img-fluid"></a>
            <div class="text">
                <h3><?=$regPpal['cNombre']?></h3>
                <p class="price">$<?=number_format($regPpal['nValor'],2,',','.')?></p>
                <h4 class="text-center"><?=$regPpal['cAnexo01']?></h4>
            </div>
        </div>
    </div>
    <?php }  ?>

</div>
