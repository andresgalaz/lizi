<?php
// versión 2.0
// modificación 23/03/2016

// Inicia sesion
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/*
 * ========================================================== Conexión a la base de datos
 * ==========================================================
 */
$id_cnx = mysqli_connect('localhost', 'liziechevarria_usr', '3MsX5fGy9');
if (! $id_cnx) {
	die ( 'Could not connect : ' . mysqli_error ($id_cnx) );
}
mysqli_set_charset($id_cnx, 'utf8');
$db_selected = mysqli_select_db($id_cnx,'liziechevarria_db');
if (! $db_selected) {
	die ( 'No existe base : ' . mysqli_error ($id_cnx) );
}
$GL_LOC_GLOBAL = 9999;
$GL_DIR = '';

/**
 * <p>Recibe los valores por GET/POST o REQUEST. Previene el error si no existe el parámetro.</p>
 *
 * @param string $nomVar Nombre del parámetro
 * @param string $valDefecto Valor por defecto si el parámetro no existe
 * @return string
 */
function getPost($nomVar, $valDefecto = '') {
	if ($nomVar == '')
		return $valDefecto;
	if (isset ( $_GET [$nomVar] ))
		return $_GET [$nomVar];
	if (isset ( $_POST [$nomVar] ))
		return $_POST [$nomVar];
	if (isset ( $_REQUEST [$nomVar] ))
		return $_REQUEST [$nomVar];
	return $valDefecto;
}

/**
 * Busca todos los archivos dentro del directorio
 *
 * @param string $rootDir
 * @param array $allData parámetro in out
 * @return array string
 */
function scanDirectories($rootDir, $allData = array()) {
	// set filenames invisible if you want
	$invisibleFileNames = array (
			".",
			"..",
			".htaccess",
			".htpasswd" );
	// run through content of root directory
	$dirContent = scandir ( $rootDir );
	foreach ( $dirContent as $key => $content ) {
		// filter all files not accessible
		$path = $rootDir . '/' . $content;
		if (! in_array ( $content, $invisibleFileNames )) {
			// if content is file & readable, add to array
			if (is_file ( $path ) && is_readable ( $path )) {
				// save file name with path
				$allData [] = $path;
				// if content is a directory and readable, add path and name
			} elseif (is_dir ( $path ) && is_readable ( $path )) {
				// recursive callback to open new directory
				$allData = scanDirectories ( $path, $allData );
			}
		}
	}
	return $allData;
}

/**
 * Mueve desde fileupdate/files a upload/{tabla}/
 *
 * @param integer $pImagen Nº PK
 * @param string $cTabla Nombre tabla
 */
function rutaImagenMueve($pImagen, $cTabla) {
	global $GL_DIR;
	if (! file_exists ( $GL_DIR . 'upload/' . $cTabla )) {
		mkdir ( $GL_DIR . 'upload/' . $cTabla, 0777, true );
	}

	$nImagenDisp = array ();
	$nIdx = 0;
	for($nImagen = 0; $nImagen < 20; $nImagen ++) {
		$arch = rutaImagen ( $pImagen, $cTabla, $nImagen, false );
		if ($arch == '') {
			// Está disponible
			$nImagenDisp [$nIdx ++] = $nImagen;
			// $arch = '../' . $arch;
			if (file_exists ( $arch ))
				unlink ( $arch );
		}
	}

	$dirContent = scanDirectories ( $GL_DIR . 'fileupdate/files' );
	$nMove = 0;
	foreach ( $dirContent as $key => $content ) {
		if (strpos ( $content, 'fileupdate/files/thumbnail' ) === false) {
			// Mueve
			if ($nMove < $nIdx) {
				$ruta = $GL_DIR . 'upload/' . $cTabla . '/' . str_pad ( $pImagen, 5, "0", STR_PAD_LEFT ) . '_' . $nImagenDisp [$nMove] . '.' . strtolower ( pathinfo ( $content, PATHINFO_EXTENSION ) );
				rename ( $content, $ruta );
			} else {
				// Ya no hay mas imágenes disponibles
				unlink ( $content );
			}
			$nMove ++;
		} else {
			// Borra thmbnail
			unlink ( $content );
		}
	}
}

/**
 * <p>Devuelve un arreglo con los archivos correspondientes</p>
 *
 * @param integer $pImagen
 * @param string $cTabla
 * @return array
 */
function listaImagen($pImagen, $cTabla) {
	global $GL_DIR;
	$ruta = $GL_DIR . 'upload/' . $cTabla . '/' . str_pad ( $pImagen, 5, "0", STR_PAD_LEFT ) . '_*';
	$arr = glob ( $ruta );
	if (strlen ( $GL_DIR ) > 0) {
		// Saca los directorios pervios del nombre de la imagen
		for($i = 0; $i < count ( $arr ); $i ++)
			$arr [$i] = substr ( $arr [$i], strlen ( $GL_DIR ) );
	}
	return $arr;
}

/**
 * <p>Devuelve la ruta de la imagen en el disco. También sube las imágenes.</p>
 *
 * @param integer $pImagen PK de la tabla
 * @param string $cTabla La tabla
 * @param integer $nImagen Nº de imagen
 * @param string $cNombreUpload Nombre del archivo de subida (upload)
 * @return string
 */
function rutaImagen($pImagen, $cTabla, $nImagen, $bImgDefecto = true) {
	global $GL_DIR;
	$ruta = $GL_DIR . 'upload/' . $cTabla . '/';
	$ruta = $ruta . str_pad ( $pImagen, 5, "0", STR_PAD_LEFT ) . '_' . $nImagen;

	$archEnc = '';
	foreach ( glob ( "$ruta.*" ) as $filename ) {
		$archEnc = $filename;
	}
	// Imagen por defecto
	if ($archEnc == ''){
		if( $bImgDefecto )
			$archEnc = $GL_DIR . 'upload/' . $cTabla . '/00000_' . ($nImagen == 0 ? '0' : '1') . '.jpg';
		else
			return $archEnc;
	}
	// Saca los directorios previos del nombre de la imagen
	if ($GL_DIR == '')
		return $archEnc;
	return substr ( $archEnc, strlen ( $GL_DIR ) );
}

/**
 * <p>Ubica y elimina todas las imagenes del disco,asociados a una PK y tabla</p>
 *
 * @param integer $pImagen PK de la tabla
 * @param string $cTabla
 */
function deleteImagen($pImagen, $cTabla) {
	for($nImagen = 0; $nImagen < 20; $nImagen ++) {
		$arch = rutaImagen ( $pImagen, $cTabla, $nImagen );
		if ($arch != '') {
			// $arch = '../' . $arch;
			if (file_exists ( $arch ))
				unlink ( $arch );
		}
	}
}

function jsonBase64decode($cVal) {
	try {
		$cVal2 = base64_decode ( $cVal );
		return json_decode ( $cVal2 );
	}
	catch ( Exception $e ) {
		error_log ( 'jsonBase64decode_2: error' );
	}
	$cVal = utf8_decode ( base64_decode ( $cVal ) );
	$x = json_decode ( $cVal );

	return json_decode ( $cVal );
}
/**
 * <p>Convierte una tabla MYSQL a JSON.</p>
 *
 * @param string $cTabla Nombre de la tabla a convertir
 */
function echoJsonEncode($data) {
	header ( 'Content-type: application/json; charset=UTF-8' );
	echo json_encode ( $data, JSON_UNESCAPED_UNICODE );
}

/**
 * Ejecuta sentencias SQL
 *
 * @param object $operacion está conformado por accion : 'delete' 'update', tabla, pk (arreglo de string), registro
 *        (datos) y orden string
 * @return object oResp: mensaje, success y records
 */
function ejecutaSql($operacion) {
	global $id_cnx;

	mysqli_query ( $id_cnx, "SET NAMES 'utf8'" );
	$oResp = new stdClass ();
	$oResp->success = false;
	if ($operacion->accion == 'delete') {
		/*
		 * operacion = { accion:'delete' , tabla:'principal' , pk:[] }
		 */
		// Inicializa condición para el where
		$condicion = '1=1';
		foreach ( $operacion->pk as $i => $fieldPk )
			$condicion .= " and $fieldPk = '" . $operacion->registro->$fieldPk . "'";
		if ($condicion == '1=1') {
			// Error no hay condición de borrado
			$oResp->mensaje = 'No hay condición de borrado';
		} else {
			if (! mysqli_query ($id_cnx, 'DELETE FROM ' . $operacion->tabla . ' WHERE ' . $condicion ))
				$oResp->mensaje = mysqli_error ($id_cnx);
			else
				$oResp->success = true;
		}
	} else if ($operacion->accion == 'update') {
		/*
		 * operacion = { accion:'update' , tabla:'principal' , pk:[], registro:{} }
		 */
		// Si la PK no viene vacía o parcialmente vacía, es un update
		$bInserta = false;
		foreach ( $operacion->pk as $i => $fieldPk )
			$bInserta |= ($operacion->registro->$fieldPk == '');
		if ($bInserta) {
			// Inserta
			$campos = '';
			$valores = '';
			foreach ( $operacion->registro as $field => $valor ) {
				if(count($operacion->pk)==1 && $operacion->pk[0]==$field && $valor=='')
					continue;

				$campos .= $field . ',';
				$valores .= "'$valor',";
			}			
			$cSql = 'INSERT INTO ' . $operacion->tabla . ' (' . substr ( $campos, 0, - 1 ) . ') values (' . substr ( $valores, 0, - 1 ) . ')';
			$oResp->mensaje = 'Registro insertado correctamente';
		} else {
			// Actualiza
			$setCampo = '';
			$condicion = '1=1';
			foreach ( $operacion->registro as $field => $valor ) {
				if (in_array ( $field, $operacion->pk ))
					$condicion .= " and $field = '$valor'";
				else
					$setCampo .= $field . "='$valor',";
			}
			$cSql = 'UPDATE ' . $operacion->tabla . ' set ' . substr ( $setCampo, 0, - 1 ) . ' where ' . $condicion;
			$oResp->mensaje = 'Registro actualizado correctamente';
		}
		if (mysqli_query ( $id_cnx, $cSql )) {
			$oResp->lastId = mysqli_insert_id ($id_cnx);
			$oResp->success = true;
		} else
			$oResp->mensaje = mysqli_error ($id_cnx);

	} else if ($operacion->accion == 'list') {
		/*
		 * operacion = { accion:'list' , tabla:'principal' , orden:'cNombre' }
		 */
		$cSql = "SELECT * FROM $operacion->tabla ";
		if (isset ( $operacion->where ) && $operacion->where != '')
			$cSql .= " WHERE $operacion->where ";
		if (isset ( $operacion->orden ) && $operacion->orden != '')
			$cSql .= " ORDER BY $operacion->orden ";
		$cursor = mysqli_query ( $id_cnx, $cSql );
		if (! $cursor) {
			$oResp->mensaje = mysqli_error ($id_cnx);
		} else {
			$rows = array ();
			while ( $row = mysqli_fetch_assoc ( $cursor ) )
				$rows [] = $row;
				// Si es una lista solo se envían los registros, sin mensaje no success
			$oResp = $rows;
		}
	}
	return $oResp;
}

/**
 * Elimina acentos. Útil si hay dudas con la codificación.
 * @param string $cadena String con el contenido a modificar
 * @return string convertido
 */
function normaliza ($cadena){
    $originales  = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}

/**
 * Envía un mail con codificación UTF-8
 *
 * @param string $destino Email destinatario
 * @param string $asunto
 * @param string $body Mensaje del correo
 * @param string $from_name Nombre de quien envía
 * @param string $from_a Correo de quien envía
 * @param string $reply Correo para responder
 * @return void
 */
function utf8mail($destino, $asunto, $body, $from_name = "compustrom", $from_a = "webmaster@xum2.ibumu.com", $reply = "no-responder@compustrom.com")
{
	// Para pruebas 
	// $destino='andres.galaz@gmail.com';

	// Mientras está en modo de pruebas
	$from_a = "webmaster@xum2.ibumu.com";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "From: =?utf-8?b?" . base64_encode($from_name) . "?= <" . $from_a . ">\r\n";
    $headers .= "Content-Type: text/plain;charset=utf-8\r\n";
    $headers .= "Reply-To: $reply\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
	$mailSent = mail($destino, "=?utf-8?b?" . base64_encode($asunto) . "?=", $body, $headers);
	$mailSent = mail('andygalazv@hotmail.com', normaliza("$asunto"), $body, 'from: info@liziechevarria.com');
}
