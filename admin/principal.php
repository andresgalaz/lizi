<?php include 'serverAjax/sesion.php'?>
<!DOCTYPE html>
<html>
    <?php include 'include/head.php'?>
    <body class='tailor-cover'>
        <?php include 'include/menu.php'?>
        <div class='container-fluid'>
		<div class='row'>
			<div id="div_usuario" class="col-md-7 pull-right text-right"				style="margin-bottom: 10px;"></div>
		</div>
<?php if( $usuario != null ){?>
        	<?php include 'principal_tabla.php'?>
			<br />
        	<?php include 'principal_frm.php'?>
			<br />
        	<?php include 'include/imagen_admin.php'?>
<?php } else {?>			
	Usted no está conectado !
<?php } ?>			
        	</div>
        <?php include 'include/footer.php'?>
		<script src='principal.js' type='text/javascript'></script>
	</body>
</html>
