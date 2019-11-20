<?php
include '../conexion.php';
$GL_MAX_ITEMS_PAGINA = 99;

// Parámetros del request
$cTextoBusqueda = getPost('cTextoBusqueda');
$cNavega = getPost('cNavega');
$cOrden = getPost('cOrden');
$nPagina = getPost('nPagina');
$nItemsPagina = getPost('nItemsPagina');
$cTipoFiltro = getPost('cTipoFiltro');
$cProvinciaFiltro = getPost('cProvinciaFiltro');
$cTpVarios01Filtro = getPost('cTpVarios01Filtro');

if ($cOrden == '') {
    $cOrden = 'Relevancia';
}

if ($nItemsPagina == '') {
    $nItemsPagina = 12;
}

if ($nPagina == '' || $nPagina <= 0) {
    $nPagina = 1;
}

// Avanza retrocede
if ($cNavega == 'previo') {
    $nPagina--;
    if ($nPagina <= 0) {
        $nPagina = 1;
    }
} elseif ($cNavega == 'siguiente') {
    $nPagina++;
}

// Titulo de la categoría mostrada y 'Bread Crum'
$cTitulo = '';
$cBreadCrumb = '';

// Link con parámetros originales
$cLinkOriginal = "?";
if ($cTipoFiltro != '') {
    $cLinkOriginal = "?cTipoFiltro=$cTipoFiltro";
    if ($cTipoFiltro != 'Todos') {
        $cBreadCrumb .= $cTipoFiltro . ' ';
    }
}

$cWhere = "";
if ($cTipoFiltro == 'Todos') {
    $cWhere .= (strlen($cWhere) > 0 ? " AND " : "") . "1=1";
} elseif ($cTipoFiltro != '') {
    $cWhere .= (strlen($cWhere) > 0 ? " AND " : "") . "cTipo = '$cTipoFiltro'";
}

if ($cProvinciaFiltro != '') {
    $cLinkOriginal = "?cProvinciaFiltro=$cProvinciaFiltro";
    $cWhere .= (strlen($cWhere) > 0 ? " AND " : "") . "cProvincia = '$cProvinciaFiltro'";
    $cBreadCrumb .= $cProvinciaFiltro . ' ';
}
if ($cTpVarios01Filtro != '') {
    $cLinkOriginal = "?cTpVarios01Filtro=$cTpVarios01Filtro";
    $cWhere .= (strlen($cWhere) > 0 ? " AND " : "") . "cTpVarios01 = '$cTpVarios01Filtro'";
    $cBreadCrumb .= $cTpVarios01Filtro . ' ';
}

if ($cTextoBusqueda != '') {
    $cBreadCrumb .= 'Búsqueda';
    $cTitulo .= "Criterio de búsqueda: $cTextoBusqueda";
    $cWhere .= (strlen($cWhere) > 0 ? " AND " : "") .
        "( cNombre like '%$cTextoBusqueda%' OR cDescripcion like '%$cTextoBusqueda%' OR cExtendido like '%$cTextoBusqueda%' )";
}

$nTotalItems = 0;
$cSql = "SELECT count(*) nCantidad FROM vPrincipal WHERE bHabilitado='1' AND $cWhere ";
$rs = $id_cnx->query($cSql);
if ($rs != false) {
    $fila = $rs->fetch_assoc();
    $nTotalItems = $fila['nCantidad'];
    $rs->close();
}

// Limita si excede la última página
$nLastPagina = ceil($nTotalItems / $nItemsPagina);
if ($nLastPagina == 0) {
    $nLastPagina = 1;
}
if ($nPagina > $nLastPagina) {
    $nPagina = $nLastPagina;
}

// Prepara cursores
$cSql = "SELECT pPrincipal,pAnexo01,cNombre,cDescripcion,dFecha,cMarca,cExtendido,nFactor,nValor,tModif,cAnexo01,cTipo,nStock FROM vPrincipal WHERE bHabilitado='1' AND $cWhere ";
if ($cOrden == 'Nombre') {
    $cSql .= ' ORDER BY cNombre ';
} elseif ($cOrden == 'Menor Precio') {
    $cSql .= ' ORDER BY nValor ASC';
} elseif ($cOrden == 'Mayor Precio') {
    $cSql .= ' ORDER BY nValor DESC';
} elseif ($cOrden == 'Relevancia') {
    $cSql .= ' ORDER BY nFactor DESC';
}
$cSql .= " limit " . (($nPagina - 1) * $nItemsPagina) . ", $nItemsPagina";
$rs = $id_cnx->query($cSql);

$arrPpal = array();
if ($rs != false) {
    $curAttr = $id_cnx->prepare("SELECT cAtributo FROM principal_atributo WHERE pPrincipal = ? "); // and cAtributo in ( 'Nuevo', 'OfertasDia', 'Descuento')");
    // Transfiera datos de la base a un arreglo
    while ($fila = $rs->fetch_assoc()) {
        $curAttr->bind_param('i', $fila['pPrincipal']);
        $curAttr->execute();
        $curAttr->bind_result($cAtributo);
        while ($curAttr->fetch()) {
            $fila[$cAtributo] = '1';
        }
        $curAttr->free_result();
        array_push($arrPpal, $fila);
    }
    $rs->close();
}
?>
<!DOCTYPE html>
<html>
  <head>
  <?php include 'include/head.php'?>
  </head>
  <body>
    <header class="header mb-5">
      <?php include 'include/barraSup.php'?>
      <?php include 'include/menu.php'?>
    </header>

    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href=".">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active"><?=$cBreadCrumb?></li>
                </ol>
              </nav>

              <div class="box">
                <h1><?=($cTitulo == '' ? $cBreadCrumb : $cTitulo)?></h1>
                <!-- <p>Comentarios acerca del tipo de filtro (opcional)</p> -->
              </div>
              <div class="box info-bar">
                <div class="row">

                  <div class="col-md-12 col-lg-4 products-showing">Mostrando <strong><?=count($arrPpal)?></strong> of <strong><?=$nTotalItems?></strong> productos</div>

                  <div class="col-md-12 col-lg-7 products-number-sort">
                    <form class="form-inline d-block d-lg-flex justify-content-between flex-column flex-md-row">
                      <div class="products-number">
                        <strong>Mostrando</strong>
                        <a href="<?=$cLinkOriginal?>&nItemsPagina=12" class="<?=$nItemsPagina == 12 ? 'btn btn-sm btn-primary' : 'btn btn-outline-secondary btn-sm'?>">12</a>
                        <a href="<?=$cLinkOriginal?>&nItemsPagina=24" class="<?=$nItemsPagina == 24 ? 'btn btn-sm btn-primary' : 'btn btn-outline-secondary btn-sm'?>">24</a>
                        <a href="<?=$cLinkOriginal?>&nItemsPagina=<?=$GL_MAX_ITEMS_PAGINA?>" class="<?=$nItemsPagina == $GL_MAX_ITEMS_PAGINA ? 'btn btn-sm btn-primary' : 'btn btn-outline-secondary btn-sm'?>">Todo</a>
                        <span>productos</span></div>
                        <div class="products-sort-by mt-2 mt-lg-0"><strong>Ordenado por</strong>
                          <select name="sort-by" class="form-control" onchange='fnCambiaOrden(this);'>
                            <option <?=($cOrden == 'Relevancia' ? 'selected' : '')?>>Relevancia</option>
                            <option <?=($cOrden == 'Menor Precio' ? 'selected' : '')?>>Menor Precio</option>
                            <option <?=($cOrden == 'Mayor Precio' ? 'selected' : '')?>>Mayor Precio</option>
                            <option <?=($cOrden == 'Nombre' ? 'selected' : '')?>>Nombre</option>
                          </select>
                          <script>
                            function fnCambiaOrden(me){
                              console.log('<?=$cLinkOriginal?>&nItemsPagina=<?=$nItemsPagina?>&cOrden=' + me.value);
                              location='<?=$cLinkOriginal?>&nItemsPagina=<?=$nItemsPagina?>&cOrden=' + me.value;
                            }
                          </script>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="row products">
              <?php
// Indica la ruta relativa donde debería estar el direcotiorio 'upload' ver función rutaImagen
$GL_DIR = '../';

foreach ($arrPpal as $regPpal) {
    $imagenFront = rutaImagen($regPpal['pPrincipal'], 'principal', 0);
    $imagenBack = rutaImagen($regPpal['pPrincipal'], 'principal', 1);
    $linkDetalle = "detail.php?pPrincipal=" . $regPpal['pPrincipal'];
    ?>
                <div class="col-lg-3 col-md-4">
                  <?php include 'include/lisProductoHorDet.php'?>
                </div>
                <?php
}
?>
                <!-- /.products-->
              </div>
              <div class="pages">
              <?php include 'include/paginacion.php'?>
              </div>
            </div>
            <!-- /.col-lg-9-->
          </div>
        </div>
      </div>
    </div>

    <?php include 'include/footer.php'?>
  </body>
</html>
<?php mysqli_close($id_cnx);?>
