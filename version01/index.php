<?php include '../conexion.php'?>
<!DOCTYPE html>
<html>
  <head>
  <?php include 'include/head.php'?>
  </head>
  <body>
    <header class="header mb-5">
      <?php include 'include/barraSup.php' ?>
      <?php include 'include/menu.php' ?>
    </header>

    <div id="all">
      <div id="content">
        <?php include 'include/carruselPpal.php' ?>
        <!-- Destacados -->
        <div id="hot">
          <div class="box py-4">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <h2 class="mb-0">Ofertas del Mes</h2>
                </div>
              </div>
            </div>
          </div>

          <?php include 'include/lisProductoHorizontal.php'?>
        </div>
        <!-- Carrusel Alternativo -->
        <?php include 'include/carruselAlt.php'?>

        <!-- BLOG -->
        <?php include 'include/blog.php'?>
      </div>
    </div>

    <?php include 'include/footer.php'?>
  </body>
</html>
<?php mysqli_close( $id_cnx );?>
