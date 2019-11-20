<?php
/**
 * Requiere que estén definidos las siguientes variables:
 * nItemsPagina : Nº de items por página
 * nPagina : Página actual
 * nTotalItems : Cantidad total de items
 */
// Link paginación con parámetros originales
$cLinkPagina = "?";
if ($cTipoFiltro != '') {
    $cLinkPagina = "?cTipoFiltro=$cTipoFiltro";
}
$cLinkPagina .= "&nItemsPagina=$nItemsPagina&cOrden=$cOrden";

if($nItemsPagina < $nTotalItems){
?>
<!-- <p class="loadMore btn btn-primary btn-lg">
    <i class="fa fa-chevron-down"></i> Cargar más
</p> -->
<nav aria-label="Page navigation example" class="d-flex justify-content-center">
    <ul class="pagination">
        <li class="page-item"><a href="<?=$cLinkPagina?>&nPagina=<?=$nPagina?>&cNavega=previo" aria-label="Previous" class="page-link"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
        <?php 
        $nCount = 0;
        while ($nCount < $nTotalItems) {
            $nCalcPag = ($nCount / $nItemsPagina) + 1;
            if ($nCalcPag == $nPagina) {
        ?>
        <li class="page-item active"><a href="#" class="page-link"><?=$nCalcPag?></a></li>
        <?php
            } else {
        ?>
        <li class="page-item"><a href="<?=$cLinkPagina?>&nPagina=<?=$nCalcPag?>&cNavega=saltar" class="page-link"><?=$nCalcPag?></a></li>
        <?php 
            }
            $nCount += $nItemsPagina;
        }
        ?>
        <li class="page-item">
            <a href="<?=$cLinkPagina?>&nPagina=<?=$nPagina?>&cNavega=siguiente" aria-label="Next" class="page-link">
                <span aria-hidden="true">»</span><span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>
<?php
}
?>
