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
                  <li aria-current="page" class="breadcrumb-item active">nosotros</li>
                </ol>
              </nav>
            </div>
            <?php include 'include/menuPages.php'?>

            <div class="col-lg-9">
              <div id="contact" class="box">
                <h1>¿Quienes Somos?</h1><br/>
                <h2>¿Por qué hacemos lo que hacemos?</h2>
                <p class="lead">Porque estamos convencidos de que se puede disfrutar el vino, divertirse con el vino y
                aprender sobre el vino.</p>

                <h2>¿Cómo lo hacemos?</h2>
                <p class="lead">Intentando satisfacer lo que esperás y sorprenderte con lo que no esperás, a través de
                una experiencia que sea entretenida sin dejar de ser seria, y pensada para todos sin
                dejar de enfocarse en vos.</p>

                <h2>¿Qué hacemos?</h2>
                <p class="lead">Vendemos vinos no-tan-fáciles-de-conseguir, degustaciones dinámicas y originales y
                charlas amenas y didácticas.<p/>

                <h2>¿Quién es Bastiano?</h2>
                <p class="lead">Un apasionado del vino y su mundo, curioso por naturaleza, entusiasta experimentador
                que encuentra en compartir sus conocimientos un gran placer.</br>
                <br>
                Además, es Catador Profesional con certificado de la Escuela Argentina de Vinos
                (avalado por el Ministerio de Educación del Gobierno de la Ciudad de Buenos Aires).</p>
                <hr>
              </div>
            </div>
            <!-- /.col-lg-9-->
          </div>
        </div>
      </div>
    </div>

    <?php include 'include/footer.php'?>
  </body>
</html>
<?php mysqli_close($id_cnx);?>
