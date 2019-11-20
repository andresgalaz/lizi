<?php include '../conexion.php'?>
<?php include 'include/cargaCompra.php' ?>
<!DOCTYPE html>
<html>
  <head>
  <?php include 'include/head.php'?>
<link href="https://portal.todopago.com.ar/app/css/boton.css" rel="stylesheet">
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
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Compra - Revisión Final</li>
                </ol>
              </nav>
            </div>
            <div id="checkout" class="col-lg-9">
              <div class="box">
                <form method="get" onsubmit='callTodoPago(this); return false;' action="todoPagoInicio.php">
                  <h1>Compra - Revisión Final</h1>
                  <div class="nav flex-column flex-sm-row nav-pills">
                    <a href="checkout1.php" class="nav-link flex-sm-fill text-sm-center">
                      <i class="fa fa-map-marker"></i>Dirección
                    </a>
                    <!-- <a href="checkout2.php" class="nav-link flex-sm-fill text-sm-center">
                      <i class="fa fa-truck"></i>Despacho
                    </a>
                    <a href="checkout3.php" class="nav-link flex-sm-fill text-sm-center">
                      <i class="fa fa-money"></i>Método de Pago
                    </a> -->
                    <a href="#" class="nav-link flex-sm-fill text-sm-center active">
                      <i class="fa fa-eye"></i>Revisión Final
                    </a>
                  </div>
                  <div class="content">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th colspan="2">Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <!-- <th>Descuento</th> -->
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
// Indica la ruta relativa donde debería estar el direcotiorio 'upload' ver función rutaImagen
$GL_DIR = '../';

foreach ($arrCompra as $regPpal) {
    $imagenDetalle = rutaImagen($regPpal['pPrincipal'], 'principal', 0);
    $linkDelete = "?pPrincipal=" . $regPpal['pPrincipal'] . '&eliminar=1';
    $linkDetalle = "detail.php?pPrincipal=" . $regPpal['pPrincipal'];
    if($regPpal['nCantidad']<=0){
      continue;
    }?>
                        <tr>
                          <td><img src="../<?=$imagenDetalle?>" alt="<?=$regPpal['cProducto']?>"></td>
                          <td><?=$regPpal['cProducto']?></td>
                          <td><?=$regPpal['nCantidad']?></td>
                          <td>$<?=number_format($regPpal['nValor'], 2, ',', '.')?></td>
                          <!-- <td>$0.00</td> -->
                          <td>$<?=number_format($regPpal['nValor'] * $regPpal['nCantidad'], 2, ',', '.')?></td>
                        </tr>
<?php
}
?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th colspan="5">Total</th>
                            <th>$<?=number_format($nMontoTotal, 2, ',', '.')?></th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.table-responsive-->
                  </div>
                  <!-- /.content-->
                  <div class="box-footer d-flex justify-content-between">
                    <a href="checkout1.php" class="btn btn-outline-secondary">
                      <!-- <i class="fa fa-chevron-left"></i>A Método de Pago -->
                      <i class="fa fa-chevron-left"></i>A Dirección
                    </a>
                    <button type="submit" class="btn btn-primary">Pagar<i class="fa fa-chevron-right"></i></button>
                  </div>
                </form>
              </div>
              <!-- /.box-->
            </div>
            <!-- /.col-lg-9-->
            <div class="col-lg-3">
              <div id="order-summary" class="card">
              <div class="card-header">
                  <h3 class="mt-4 mb-4">Resumen de su Compra</h3>
                </div>
                <div class="card-body">
                  <?php include 'include/resumenCompra.php' ?>
                </div>
              </div>
            </div>
            <!-- /.col-lg-3-->
          </div>
        </div>
      </div>
    </div>

    <?php include 'include/footer.php'?>
  </body>
</html>
<?php mysqli_close($id_cnx);?>
