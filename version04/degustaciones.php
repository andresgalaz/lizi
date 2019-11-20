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
                  <li aria-current="page" class="breadcrumb-item active">Degustaciones</li>
                </ol>
              </nav>
            </div>
            <?php include 'include/menuPages.php'?>

            <div class="col-lg-9">
              <div id="contact" class="box">
                <h1>Degustaciones y Charlas</h1>
                <!-- <p class="lead">¿Tiene preguntas acerca de algo? ¿Tiene algún tipo de problema con nuestros productos?</p>
                <p>Si desea puede contactarse con nosotros .</p> -->
                <hr>
                <div id="accordion">
                  <div class="card border-primary mb-3">
                    <div id="heading01" class="card-header p-0 border-0">
                      <h4 class="mb-0"><a href="#" data-toggle="collapse" data-target="#collapse01" aria-expanded="true" aria-controls="collapse01" class="btn btn-primary d-block text-left rounded-0">
                        Desgustaciones</a>
                      </h4>
                    </div>
                    <div id="collapse01" aria-labelledby="heading01" data-parent="#accordion" class="collapse show">
                      <div class="card-body">
                        <p>
                        Todos los eventos tienen como base una degustación de al menos cuatro vinos.<br/>
                        <br/>
                        La dinámica se centra en el proceso clásico de degustación, de manera ordenada,
                        pero desacartonada y buscando la participación de todos los asistentes. El
                        objetivo es lograr un buen balance entre lo hedonista, lo lúdico y lo técnico.<br/>
                        <br/>
                        Los temas que se pueden abordar van desde vinos de una misma variedad hasta
                        vinos de distintas regiones, pasando por cualquier combinación posible (y realizable),
                        incluyendo en algunos casos juegos y concursos.<br/>
                        <br/>
                        La duración aproximada es de una hora a una hora y media, dependiendo en gran
                        medida de la cantidad de asistentes.
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="card border-primary mb-3">
                    <div id="heading01a" class="card-header p-0 border-0">
                      <h4 class="mb-0"><a href="#" data-toggle="collapse" data-target="#collapse01a" aria-expanded="false" aria-controls="collapse01a" class="btn btn-primary d-block text-left rounded-0">
                        Charlas</a>
                      </h4>
                    </div>
                    <div id="collapse01a" aria-labelledby="heading01a" data-parent="#accordion" class="collapse">
                      <div class="card-body">
                      A la degustación básica se le puede agregar una charla que profundice sobre conceptos
                      relacionados ya sea con el proceso de degustación o con el tema central elegido para
                      la misma.<br/>
                      <br/>
                      El lenguaje y la profundidad de los contenidos se adapta al perfil general de los
                      asistentes, buscando asegurar el logro de un buen balance entre lo hedonista, lo lúdico
                      y lo técnico.<br/>
                      <br/>
                      La duración aproximada de la degustación básica más la charla puede ser de dos horas
                      a dos horas y media, dependiendo en gran medida de la cantidad de asistentes.
                      </div>
                    </div>
                  </div>

                  <div class="card border-primary mb-3">
                    <div id="heading02" class="card-header p-0 border-0">
                      <h4 class="mb-0"><a href="#" data-toggle="collapse" data-target="#collapse02" aria-expanded="false" aria-controls="collapse02" class="btn btn-primary d-block text-left rounded-0">
                      Alta Gama</a>
                      </h4>
                    </div>
                    <div id="collapse02" aria-labelledby="heading02" data-parent="#accordion" class="collapse">
                      <div class="card-body">
                      En esta opción, al menos tres de los cuatro vinos que se incluyen son de alta gama.
                      </div>
                    </div>
                  </div>


                  <div class="card border-primary mb-3">
                    <div id="heading03" class="card-header p-0 border-0">
                      <h4 class="mb-0"><a href="#" data-toggle="collapse" data-target="#collapse03" aria-expanded="false" aria-controls="collapse03" class="btn btn-primary d-block text-left rounded-0">
                      Consideraciones Varias</a>
                      </h4>
                    </div>
                    <div id="collapse03" aria-labelledby="heading03" data-parent="#accordion" class="collapse">
                      <div class="card-body">
                      Las degustaciones se pueden realizar en tu casa, tu empresa o en algún lugar que vos
                      dispongas.<br/>
                      <br/>
                      La cantidad de asistentes mínima es 4 y la máxima 20, siendo 10 una cantidad ideal
                      para que todos puedan participar y el tiempo no atente contra la dinámica.<br/>
                      <br/>
                      Este servicio incluye, además de los vinos, todo el material necesario para llevarlo
                      a cabo. No incluye infraestructura tecnológica ni catering.
                      </div>
                    </div>
                  </div>

                  <div class="card border-primary mb-3">
                    <div id="heading04" class="card-header p-0 border-0">
                      <h4 class="mb-0"><a href="#" data-toggle="collapse" data-target="#collapse04" aria-expanded="false" aria-controls="collapse04" class="btn btn-primary d-block text-left rounded-0">
                      Precios (por asistente)</a>
                      </h4>
                    </div>
                    <div id="collapse04" aria-labelledby="heading04" data-parent="#accordion" class="collapse">
                      <div class="card-body">
                      Degustación básica: $800 / adicional por charla: $200 / adicional por alta gama: $150<br/>
                      <br/>
                      El precio puede cambiar sin previo aviso. Cualquier cotización mantendrá su valor
                      durante una semana. Transcurrida la semana sin haberse efectuado la compra, la cotización
                      queda sin efecto.
                      </div>
                    </div>
                  </div>

                  <div class="card border-primary mb-3">
                    <div id="heading05" class="card-header p-0 border-0">
                      <h4 class="mb-0"><a href="#" data-toggle="collapse" data-target="#collapse05" aria-expanded="false" aria-controls="collapse05" class="btn btn-primary d-block text-left rounded-0">
                      ¿Cómo contratar?</a>
                      </h4>
                    </div>
                    <div id="collapse05" aria-labelledby="heading05" data-parent="#accordion" class="collapse">
                      <div class="card-body">
                      Envianos un mensaje vía <a href="contact.php">e-mail</a> con tu consulta.<br/>
                      <br/>
                      Una vez que hayamos definido mutuamente los contenidos, adicionales y cantidad de asistentes,
                      nos pondremos de acuerdo en la forma de pago y facturación (alguien compra y paga en general
                      o bien cada asistente lo hace por separado).<br/>
                      <br/>
                      El monto en su totalidad debe ser abonado al menos 48 horas antes del evento.<br/>
                      </div>
                    </div>
                  </div>


                </div>
                <!-- /.accordion-->
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
