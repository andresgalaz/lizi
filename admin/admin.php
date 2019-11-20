<?php include 'serverAjax/sesion.php'?>
<!DOCTYPE html>
<html>
    <?php include 'head.php' ?>
    <body class='tailor-cover'>
        <?php include 'menu.php'?>
        <div class='container'>
<?php if( $usuario != null ){?>
            <div class='row'>
                <div id="div_usuario" class="col-md-7 pull-right text-right" style="margin-bottom: 10px;"></div>
            </div>
<?php } else {?>			
	Usted no está conectado !
<?php } ?>			
        </div>
        <?php include 'footer.php'?>
    </body>
</html>
