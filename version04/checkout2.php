<?php include '../conexion.php'?>
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
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Compra - Envío</li>
                </ol>
              </nav>
            </div>
            <div id="checkout" class="col-lg-9">
              <div class="box">
                <form method="get" action="checkout3.php">
                  <h1>Compra - Delivery method</h1>
                  <div class="nav flex-column flex-md-row nav-pills text-center">
                    <a href="checkout1.php" class="nav-link flex-sm-fill text-sm-center">
                      <i class="fa fa-map-marker"></i>Dirección
                    </a>
                    <a href="checkout2.php" class="nav-link flex-sm-fill text-sm-center active">
                      <i class="fa fa-truck"></i>Envío
                    </a>
                    <a href="#" class="nav-link flex-sm-fill text-sm-center disabled">
                      <i class="fa fa-money"></i>Método de Pago
                    </a>
                    <a href="#" class="nav-link flex-sm-fill text-sm-center disabled">
                      <i class="fa fa-eye"></i>Revisión Final
                    </a>
                  </div>
                  <div class="content py-3">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="box shipping-method">
                          <h4>USPS Next Day</h4>
                          <p>Get it right on next day - fastest option possible.</p>
                          <div class="box-footer text-center">
                            <input type="radio" name="delivery" value="delivery1">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="box shipping-method">
                          <h4>USPS Next Day</h4>
                          <p>Get it right on next day - fastest option possible.</p>
                          <div class="box-footer text-center">
                            <input type="radio" name="delivery" value="delivery2">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="box shipping-method">
                          <h4>USPS Next Day</h4>
                          <p>Get it right on next day - fastest option possible.</p>
                          <div class="box-footer text-center">
                            <input type="radio" name="delivery" value="delivery3">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-footer d-flex justify-content-between">
                    <a href="checkout1.php" class="btn btn-outline-secondary">
                      <i class="fa fa-chevron-left"></i>A Dirección
                    </a>
                    <button type="submit" class="btn btn-primary">
                      A Método de Pago
                      <i class="fa fa-chevron-right"></i>
                    </button>
                  </div>
                </form>
              </div>
              <!-- /.box-->
            </div>
            <!-- /.col-md-9-->
            <div class="col-md-3">
              <div id="order-summary" class="card">
                <div class="card-header">
                <h3 class="mt-4 mb-4">Resumen de su Compra</h3>
                </div>
                <div class="card-body">
                  <?php include 'include/resumenCompra.php' ?>
                </div>
              </div>
            </div>
            <!-- /.col-md-3-->
          </div>
        </div>
      </div>
    </div>

    <?php include 'include/footer.php'?>
  </body>
</html>
<?php mysqli_close($id_cnx);?>
