<?php
include '../conexion.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['cTituloMensaje'])) {
    $cTituloMensaje = $_SESSION['cTituloMensaje'];
}
if (isset($_SESSION['cCodigoMensaje'])) {
    $cCodigoMensaje = $_SESSION['cCodigoMensaje'];
}
if (isset($_SESSION['cMensaje'])) {
    $cMensaje = $_SESSION['cMensaje'];
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
                  <li aria-current="page" class="breadcrumb-item active"><?=$cCodigoMensaje?></li>
                </ol>
              </nav>
              <div id="error-page" class="row">
                <div class="col-md-6 mx-auto">
                  <div class="box text-center py-5">
                    <p class="text-center"><img src="img/logo.png" alt="Obaju template"></p>
                    <h3><?=$cTituloMensaje?></h3>
                    <h4 class="text-muted"><?=$cCodigoMensaje?></h4>
                    <p class="text-center"><?=$cMensaje?></p>
                    <p class="buttons"><a href="." class="btn btn-primary"><i class="fa fa-home"></i> Home </a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include 'include/footer.php'?>
  </body>
</html>
<?php mysqli_close($id_cnx);?>
