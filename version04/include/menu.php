<?php
// Prepara SQl para atributos, solo interesa NUEVO (por ahora)
if (!($rsTipo = $id_cnx->query("SELECT cTipo,count(*) nCantidad FROM vPrincipal WHERE bHabilitado='1' group by cTipo")))
    error_log($id_cnx->error . ":\n" . $cSql);

// Transfiera datos de la base a un arreglo
$arrTipo = array();
$nTotal = 0;
while ($fila = $rsTipo->fetch_assoc()) {
    $nTotal += $fila['nCantidad'];
    array_push($arrTipo, $fila);
}
array_push($arrTipo, array('cTipo' => 'Todos', 'nCantidad' => $nTotal));
$rsTipo->free_result();

// Items del carrito
$pCliente = session_id();
$rsCompra = $id_cnx->query("SELECT count(*) nCantidad FROM vCompra WHERE tCompra IS NULL AND fCliente = '$pCliente'");
$fila = $rsCompra->fetch_assoc();
$nItemsCarro = $fila['nCantidad'];
$rsCompra->free_result();

?>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a href="." class="navbar-brand home">
            <img src="img/logo.png" alt="Compustrom logo" class="d-none d-md-inline-block">
            <img src="img/logo-small.png" alt="Compustrom logo" class="d-inline-block d-md-none">
            <span class="sr-only">Volver a Home</span>
        </a>
        <div class="navbar-buttons">
            <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler">
                <span class="sr-only">Menú</span><i class="fa fa-align-justify"></i>
            </button>

            <button type="button" data-toggle="collapse" data-target="#search" class="btn btn-outline-secondary navbar-toggler">
                <span class="sr-only">Busca</span><i class="fa fa-search"></i>
            </button>
            <a href="basket.php" class="btn btn-outline-secondary navbar-toggler"><i class="fa fa-shopping-cart"></i></a>
        </div>
        <div id="navigation" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item menu-large"><a href="." class="nav-link">HOME<b class="caret"></b></a></li>
                <li class="nav-item menu-large"><a href="nosotros.php" class="nav-link">¿Quienes Somos?<b class="caret"></b></a></li>
                <li class="nav-item dropdown menu-large">
                    <!-- <li class="nav-item dropdown menu"> -->
                    <a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="2000" class="dropdown-toggle nav-link">Joyas<b class="caret"></b></a>
                    <ul class="dropdown-menu megamenu">
                        <li>
                            <div class="row">
                                <div class="col-md-6 col-lg-3">
                                    <h5></h5>
                                    <ul class="list-unstyled mb-3">
                                        <?php for ($i = 0; $i < count($arrTipo); $i++) { ?>
                                            <li class="nav-item"><a href="category-full.php?cTipoFiltro=<?= $arrTipo[$i]['cTipo'] ?>" class="nav-link"><?= $arrTipo[$i]['cTipo'] ?>
                                                    <?= $arrTipo[$i]['nCantidad'] ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
								<!--
                                <div class="col-md-6 col-lg-3">
                                    <h5>Otros</h5>
                                    <ul class="list-unstyled mb-3">
                                        <li class="nav-item"><a href="#" class="nav-link">Naves</a></li>
                                        <li class="nav-item"><a href="#" class="nav-link">Varios</a></li>
                                    </ul>
                                </div>
								-->
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="nav-item menu-large"><a href="legales.php" class="nav-link">Términos y Condiciones<b class="caret"></b></a></li>
                <li class="nav-item menu-large"><a href="contact.php" class="nav-link">Contacto<b class="caret"></b></a></li>
            </ul>
            <div class="navbar-buttons d-flex justify-content-end">
                <!-- /.nav-collapse-->
                <div id="search-not-mobile" class="navbar-collapse collapse"></div>
                <a data-toggle="collapse" href="#search" class="btn navbar-btn btn-primary d-none d-lg-inline-block">
                    <span class="sr-only">Búsqueda</span><i class="fa fa-search"></i>
                </a>
                <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block">
                    <a href="basket.php" class="btn btn-primary navbar-btn">
                        <i class="fa fa-shopping-cart"></i><span><?= $nItemsCarro ?> <?= ($nItemsCarro == 1 ? 'ítem' : 'items') ?> en el carrito</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Barra de Búsqueda -->
<div id="search" class="collapse">
    <div class="container">
        <form action="category-full.php" role="search" class="ml-auto" method="get">
            <div class="input-group">
                <input name="cTextoBusqueda" type="text" placeholder="Búsqueda" class="form-control">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
