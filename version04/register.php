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
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href=".">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Registro / Login</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6">
              <div class="box">
                <h1>Nueva Cuenta</h1>
                <p class="lead">¿Aún no estás registrado como cliente?</p>
                <p>El registro es necesario para hacer compras. ¡El proceso de registro solo toma un minuto!</p>
                <p class="text-muted">Antes cualquier consulta, por favor solo <a href="contact.php">contactános</a>.</p>
                <hr>
                <form onsubmit='graba(this); return false;'>
                <!-- <form action="customer-orders.html" method="post"> -->
                  <div class="form-group">
                    <label for="name">Nombre</label>
                    <input id="name" type="text" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" required>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i> Registro</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="box">
                <h1>Login</h1>
                <p class="lead">¿Ya estás ingresado?</p>
                <p class="text-muted"></p>
                <hr>
                <!-- <form action="customer-orders.html" method="post"> -->
                <form onsubmit='login(this); return false;'>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" required>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Ingresar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <?php include 'include/footer.php'?>
    <script src="js/register.js"></script>
  </body>
</html>
<?php mysqli_close( $id_cnx );?>
