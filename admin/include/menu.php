<nav class="navbar navbar-default" role="navigation">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse"
			data-target=".navbar-ex1-collapse">
			<span class="sr-only">Desplegar navegación</span> <span
				class="icon-bar"></span> <span class="icon-bar"></span> <span
				class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="admin.php">Administrador</a>
	</div>
	<!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
			<li><a href="principal.php">Principal</a></li>
			<li><a href="anexo01.php">Anexo 1</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><?php echo $usuario;?></li>
			<li class="dropdown" id="menuLogin"><a class="dropdown-toggle"
				href="#" data-toggle="dropdown" id="navLogin">Ingresar</a>
				<div class="dropdown-menu"
					style="padding: 17px; background-color: #222222;">
<?php if( $usuario == null ){ ?>
					<form class="navbar-left" role="search" method="post">
						<input name="username" id="username" class="form-control form-horizontal" placeholder="Usuario" type="text" /> <br /> 
						<input name="password" id="password" class="form-control form-horizontal" placeholder="Clave"	type="password" /> <br />
						<button type="submit" id="btnLogin" name="btnLogin" value="ingresar" class="btn btn-primary btn-sm">Ingresar</button>
					</form>
<?php } else { ?>
					<form class="navbar-left" role="search" method="post">
						<button type="submit" id="btnLogin" name="btnLogin" value="salir" class="btn btn-primary btn-sm">Salir</button>
					</form>
<?php }  ?>
				</div>
			</li>
		</ul>
	</div>
</nav>
