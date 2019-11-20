<?php
include '../conexion.php';
$GL_DIR = '../../';

// Inicia sesion
session_set_cookie_params(3600); // Set session cookie duration to 1 hour
// session_start(); ahora se inicia sesión en ../conexion.php
$usuario=null;
if ( isset($_SESSION['usuario'])){
	$usuario=$_SESSION['usuario'];
}
$btnLogin=isset($_POST['btnLogin']) ? $_POST['btnLogin'] : '';
if($btnLogin=='ingresar'){
	$username=$_POST['username'];
	$password=$_POST['password'];
	if( $username != '' && $password != '') {
		$operacion = new stdClass ();
		$operacion->accion = 'list';
		$operacion->tabla = 'usuario';
		$operacion->where = "cUsuario='$username' and cPassword='$password'";
		$regs = ejecutaSql ( $operacion );
		if( count ( $regs ) > 0 ){
			$usuario = $regs [0]['cUsuario'];
			$_SESSION['usuario'] = $usuario;
		}
	}
} else if ($btnLogin=='salir'){
	$_SESSION['usuario'] = null;
	$usuario = null;
}
mysqli_close ( $id_cnx );
?>
