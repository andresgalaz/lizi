<?php include '../conexion.php' ?>
<?php include 'include/cargaCompra.php' ?>

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
                  <li aria-current="page" class="breadcrumb-item active">Carrito</li>
                </ol>
              </nav>
            </div>

            <div class="col-lg-3 resumen-sm">
              <div id="order-summary" class="box">
                <div class="box-header">
                  <h3 class="mb-0">Resumen de su Orden</h3>
                </div>
                <?php include 'include/resumenCompra.php' ?>
              </div>
              <!-- <div class="box">
                <div class="box-header">
                  <h4 class="mb-0">Código cupón</h4>
                </div>
                <p class="text-muted">Si usted tiene un cupón de descuento, por favor ingreselo aquí.</p>
                <form>
                  <div class="input-group">
                    <input type="text" class="form-control"><span class="input-group-append">
                      <button type="button" class="btn btn-primary en-construccion"><i class="fa fa-gift"></i></button></span>
                  </div>
                </form>
              </div> -->
            </div>

            <div id="basket" class="col-lg-9">
              <div class="box">
                <form method="post" action="checkout1.php">
                  <h1>Carro de Compras</h1>
                  <p class="text-muted">Actualmente tiene <?=$nItemsCarro?> item(s) en su carro.</p>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="2">Producto</th>
                          <th>Cantidad</th>
                          <th>Precio</th>
                          <!-- <th>Descuento</th> -->
                          <th colspan="2">Total</th>
                        </tr>
                      </thead>
                      <tbody>
<?php
// Indica la ruta relativa donde debería estar el direcotiorio 'upload' ver función rutaImagen
$GL_DIR = '../';

foreach ($arrCompra as $regPpal) {
    $imagenDetalle = rutaImagen($regPpal['pPrincipal'], 'principal', 0);
    $linkDelete = "?pPrincipal=" . $regPpal['pPrincipal'] . '&eliminar=1';
    $linkDetalle = "detail.php?pPrincipal=" . $regPpal['pPrincipal'];?>
                        <tr>
                          <td><a href="<?=$linkDetalle?>"><img src="../<?=$imagenDetalle?>" alt="<?=$regPpal['cProducto']?>"></a></td>
                          <td><a href="<?=$linkDetalle?>"><?=$regPpal['cProducto']?></a></td>
                          <td>
                            <input name='nCantidad' type="number" 
                                   value="<?=$regPpal['nCantidad']?>" 
                                   class="form-control" style="width: 60px;"
                                   onchange="cambiaCantidad(this,<?=$regPpal['pPrincipal']?>,<?=$regPpal['nStock']?>);"
                                   >
                          </td>
                          <td>$<?=number_format($regPpal['nValor'], 2, ',', '.')?></td>
                          <!-- <td>$0.00</td> -->
                          <td>$<?=number_format($regPpal['nValor'] * $regPpal['nCantidad'], 2, ',', '.')?></td>
                          <td><a href="<?=$linkDelete?>"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
<?php
}
?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="4">Total</th>
                          <th colspan="2">$<?=number_format($nMontoTotal, 2, ',', '.')?></th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.table-responsive-->
                  <div class="box-footer d-flex justify-content-between flex-column flex-lg-row">
                    <div class="left"><a href="category-full.php?cTipoFiltro=Todos" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> Continuar comprando</a></div>
                    <div class="right">
                      <!-- <button class="btn btn-outline-secondary"><i class="fa fa-refresh"></i> Actualizar carro </button> -->
                      <a href="?pPrincipal=0" class="btn btn-outline-secondary"><i class="fa fa-refresh"></i> Actualizar carro </a>
                      <button type="submit" class="btn btn-primary">Comprar <i class="fa fa-chevron-right"></i></button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.box-->
              <div class=''>
                <?php
$cTitulo = "También te pueden interesar ...";
include 'include/lisProductoHorSmall.php';
?>
              </div>
            </div>

            <!-- /.col-lg-9-->
            <div class="col-lg-3 resumen-md">
              <div id="order-summary" class="box">
                <div class="box-header">
                  <h3 class="mb-0">Resumen de su Orden</h3>
                </div>
                <?php include 'include/resumenCompra.php' ?>
              </div>
              <!-- <div class="box">
                <div class="box-header">
                  <h4 class="mb-0">Código cupón</h4>
                </div>
                <p class="text-muted">Si usted tiene un cupón de descuento, por favor ingreselo aquí.</p>
                <form>
                  <div class="input-group">
                    <input type="text" class="form-control"><span class="input-group-append">
                      <button type="button" class="btn btn-primary en-construccion"><i class="fa fa-gift"></i></button></span>
                  </div>
                </form>
              </div> -->
            </div>
            <!-- /.col-md-3-->
          </div>
        </div>
      </div>
    </div>

    <?php include 'include/footer.php'?>
    <?="<script> var cMensajeNoStock = '$cMensajeNoStock'; </script>\n"?>
    <script src="js/basket.js"></script>

  </body>
</html>
<?php mysqli_close($id_cnx);?>