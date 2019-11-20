<?php include '../conexion.php'?>
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
                  <li aria-current="page" class="breadcrumb-item active">Contacto</li>
                </ol>
              </nav>
            </div>

            <?php include 'include/menuPages.php'?>

            <div class="col-lg-9">
              <div id="contact" class="box">
                <h1>Contacto</h1>
                <p class="lead">¿Tenés preguntas sobre algo?<br/>¿Tenés problemas con algunos de nuestros productos?</p>
                <p>Contactános ahora.</p>
                <hr>
                <div class="row">
                  <div class="col-md-4">
                    <h3><i class="fa fa-map-marker"></i> Dirección</h3>
                    <p>
                      <!-- Calle Nº<br> -->
                      CABA<br>
                      <!-- Código Postal<br> -->
                      Buenos Aires<br>
                      <strong>Argentina</strong>
                    </p>
                  </div>
                  <!-- /.col-sm-4-->
                  <div class="col-md-4">
                    <h3><i class="fa fa-phone"></i> Teléfono / WhatsApp</h3>
                    <p class="text-muted">Si preferís nos podés escribir o llamar al número.</p>
                    <p><strong>+549 11 6039 6306</strong></p>
                  </div>
                  <!-- /.col-sm-4-->
                  <div class="col-md-4">
                    <h3><i class="fa fa-envelope"></i> Soporte</h3>
                    <p class="text-muted">También nos podés escribir un email.</p>
                    <!-- <ul>
                      <li> -->
                      <strong><a href="mailto:">info@liziechevarria.com</a></strong>
                      <!-- </li>
                      <li><strong><a href="#">Ticketio</a></strong> - our ticketing support platform</li> 
                    </ul> -->
                  </div>
                  <!-- /.col-sm-4-->
                </div>
                <!-- /.row-->
                <!-- <hr>
                <div id="map"></div> -->
                <hr>
                <h2>Formulario de Contacto</h2>
                <form onsubmit='enviaCorreo(this); return false;'>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="firstname">Nombre</label>
                        <input id="firstname" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lastname">Apellido</label>
                        <input id="lastname" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="subject">Asunto</label>
                        <input id="subject" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="message">Mensaje</label>
                        <textarea id="message" class="form-control"></textarea>
                      </div>
                    </div>
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar mensaje</button>
                    </div>
                  </div>
                  <!-- /.row-->
                </form>
              </div>
            </div>
            <!-- /.col-md-9-->

          </div>
        </div>
      </div>
    </div>
    <?php include 'include/footer.php'?>
    <script src="js/contact.js"></script>
  </body>
</html>
<?php mysqli_close($id_cnx);?>
