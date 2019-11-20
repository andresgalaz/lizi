<?php include '../conexion.php'?>
<?php include 'include/cargaCompra.php'?>
<?php
if ($nItemsCarro == 0) {
    // No hay itemes en la compra, puede ser que el carrito esté vacío o la sesión se venció
    $_SESSION['cTituloMensaje'] = 'Al iniciar proceso de Compras';
    $_SESSION['cCodigoMensaje'] = 'Carrito vacío';
    $_SESSION['cMensaje'] = 'Para hacer la compra el carrito debe<br/>tener al menos un ítem con al menos una unidad';
    header("Location: mensaje.php");
    return;
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
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Compra - Dirección</li>
                </ol>
              </nav>
            </div>
            <div id="checkout" class="col-lg-9">
              <div class="box">
                <form method="post"  onsubmit="graba(this); return false;"> <!-- action="checkout4.php"> -->
                  <h1>Compra - Dirección</h1>
                  <div class="nav flex-column flex-md-row nav-pills text-center">
                    <a href="checkout1.php" class="nav-link flex-sm-fill text-sm-center active">
                      <i class="fa fa-map-marker"></i>Dirección
                    </a>
                    <!-- <a href="#" class="nav-link flex-sm-fill text-sm-center disabled">
                      <i class="fa fa-truck"></i>Despacho
                    </a>
                    <a href="#" class="nav-link flex-sm-fill text-sm-center disabled">
                      <i class="fa fa-money"></i>Método de Pago
                    </a> -->
                    <a href="#" class="nav-link flex-sm-fill text-sm-center disabled">
                      <i class="fa fa-eye"></i>Revisión Final
                    </a>
                  </div>
                  <div class="content py-3">
                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="cNombre">Nombre</label>
                          <input id="cNombre" value="<?=$cNombre?>" type="text" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="cApellido">Apellido</label>
                          <input id="cApellido" value="<?=$cApellido?>" type="text" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="cDireccion">Dirección</label>
                          <input id="cDireccion" value="<?=$cDireccion?>" type="text" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <!-- /.row
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="company">Company</label>
                          <input id="company" type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="street">Street</label>
                          <input id="street" type="text" class="form-control">
                        </div>
                      </div>
                    </div>
                    -->
                    <!-- /.row-->
                    <div class="row">
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                          <label for="cProvincia">Provincia</label>

                          <select id='cProvincia' class='form-control' required>
                            <option value='CABA' <?=($cProvincia == 'CABA' ? 'selected' : '')?> >CABA</option>
                            <option value='Buenos Aires' <?=($cProvincia == 'Buenos Aires' ? 'selected' : '')?>>Buenos Aires</option>
                            <!-- <option value='Otra' <?=($cProvincia == 'Otra' ? 'selected' : '')?>>Otra</option> -->
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                          <label for="cPostal">Código Postal</label>
                          <input id="cPostal" value="<?=$cPostal?>" type="text" class="form-control" required>
                        </div>
                      </div>
                      <!-- <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                          <label for="state">State</label>
                          <select id="state" class="form-control"></select>
                        </div>
                      </div> -->
                      <!-- <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                          <label for="country">Country</label>
                          <select id="country" class="form-control"></select>
                        </div>
                      </div> -->
                      <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                          <label for="cTelefono">Teléfono</label>
                          <input id="cTelefono" value="<?=$cTelefono?>" type="text" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <!-- /.row-->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="cEmail">Email</label>
                          <input id="cEmail" value="<?=$cEmail?>" type="text" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <!-- /.row-->
                  </div>
                  <div class="box-footer d-flex justify-content-between">
                    <a href="basket.php" class="btn btn-outline-secondary">
                      <i class="fa fa-chevron-left"></i>Volver al Carro
                    </a>
                    <!-- <button type="submit" class="btn btn-primary">Método Despacho<i class="fa fa-chevron-right"></i></button> -->
                    <button type="submit" class="btn btn-primary">A Revisión Final<i class="fa fa-chevron-right"></i></button>
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
                  <?php include 'include/resumenCompra.php'?>
                </div>
              </div>
            </div>
            <!-- /.col-lg-3-->
          </div>
        </div>
      </div>
    </div>

    <?php include 'include/footer.php'?>
    <script src="js/checkout.js"></script>
  </body>
</html>
<?php mysqli_close($id_cnx);?>
