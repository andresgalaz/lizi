<?php include '../conexion.php'?>
<!DOCTYPE html>
<html>
  <head>
  <?php include 'include/head.php'?>
  </head>
  <body>
    <!-- navbar-->
    <header class="header mb-5">
      <?php include 'include/barraSup.php'?>
      <?php include 'include/menu.php'?>
    </header>
    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">

            <?php include 'include/categorias.php'?>
            <?php include 'include/detProducto.php'?>

          </div>
        </div>
      </div>
    </div>
    <?php include 'include/footer.php'?>
  </body>
</html>
<?php mysqli_close( $id_cnx );?>
