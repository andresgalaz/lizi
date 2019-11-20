<?php
$GL_DIR = '../';
// Lee parámetros
$cTextoBusqueda = getPost('cTextoBusqueda');
$cOrden = (isset( $cOrden ) ? $cOrden : getPost('cOrden'));

// Arma Select Principal
$cSql = "SELECT pPrincipal,pAnexo01,cNombre,cDescripcion,dFecha,cMarca,cExtendido,nFactor,nValor,tModif,cAnexo01,cTipo,'0' as bNuevo,nStock FROM vPrincipal WHERE bHabilitado='1' ";
if ($cTextoBusqueda != '') {
    $cSql .= " AND cDescripcion LIKE '%$cTextoBusqueda%' OR cNombre LIKE '%$cTextoBusqueda%' OR cExtendido LIKE '%$cTextoBusqueda%' ";
}

if ($cOrden == 'Menor Precio') {
    $cSql .= " ORDER by nPrecio ASC";
} elseif ($cOrden == 'Mayor Precio') {
    $cSql .= " ORDER by nPrecio DESC";
} elseif ($cOrden == 'nFactor') {
    $cSql .= " ORDER by nFactor DESC";
} else {
    $cSql .= " ORDER by rand()";
}
$cSql .= " limit 12";

error_log($cSql);

// Ejecuta
if (!($result = $id_cnx->query($cSql))) {
    echo '<br/><br/><br/><br/>' . 'Invalid query: ' . mysqli_error($id_cnx) . '<br/><br/><br/><br/>';
}

// Prepara SQl para atributos, solo interesa NUEVO (por ahora)
$curAttr = $id_cnx->prepare("SELECT cAtributo FROM principal_atributo WHERE pPrincipal = ?");
// Transfiera datos de la base a un arreglo
$arrPpal = array();
while ($row = $result->fetch_assoc()) {
    $curAttr->bind_param('i', $row['pPrincipal']);
    $curAttr->execute();
    $curAttr->bind_result($cAtributo);
    while ($curAttr->fetch()) {
        $row[$cAtributo] = '1';
    }
    $curAttr->free_result();
    array_push($arrPpal, $row);
}
$result->close();

?>

<div class="container">
<div class="product-slider owl-carousel owl-theme">

<?php 
    // Indica la ruta relativa donde debería estar el direcotiorio 'upload' ver función rutaImagen
    $GL_DIR = '../';

    foreach ($arrPpal as $regPpal) {
        $imagenFront = rutaImagen($regPpal['pPrincipal'], 'principal', 0);
        $imagenBack = rutaImagen($regPpal['pPrincipal'], 'principal', 1);
        $linkDetalle = "detail.php?pPrincipal=" . $regPpal['pPrincipal'];
    ?>
    <div class="item">
        <?php include 'include/lisProductoHorDet.php' ?>
    </div>
<?php } // fin foreach ?>

    </div>
    <!-- /.product-slider-->
</div>
<!-- /.container-->
</div>
