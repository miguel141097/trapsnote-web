<?php

namespace trapsnoteWeb\Libreria;

class RecursoHTTP{


	public function POST($datos, $url){

		//Convierte el arreglo con todos los datos en un JSON
        $JSON = json_encode($datos);

 		//Crea un nuevo recurso cURL
		$conexion = curl_init($url);

		//Inicia la sesión
		@session_start();

		//Si no hubo ningún error, se procede a enviar los datos al servidor
        if($conexion != false){

			curl_setopt($conexion, CURLOPT_URL,$url);

			//Datos que se van a enviar por POST
			curl_setopt($conexion, CURLOPT_POSTFIELDS,$JSON);

			//Cabecera incluyendo la longitud de los datos de envio
			curl_setopt($conexion, CURLOPT_HTTPHEADER,array('Content-Type: application/json', 'Content-Length: '.strlen($JSON)));

			//Petición POST
			curl_setopt($conexion, CURLOPT_POST, 1);

			//HTTPGET a false porque no se trata de una petición GET
			curl_setopt($conexion, CURLOPT_HTTPGET, FALSE);

			//HEADER a false
			curl_setopt($conexion, CURLOPT_HEADER, FALSE);

			//Hace que la respuesta no sea SOLO true o false, si no, que sea la respuesta de la base de datos
			curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);

			//Captura la RESPUESTA y envia los datos a la base de datos
			$respuesta = curl_exec($conexion);

			// Cierra el recurso cURLy libera recursos del sistema
			curl_close($conexion);

			if( ($respuesta == false)||(strpos($respuesta,'Cannot POST') != false) ){
				$_SESSION['error'] = "ERROR la conexion a Trapsnote ha fallado";
				return false;
			}

		}
		else{
			$_SESSION['error'] = "ERROR no se pudo establecer conexion a Trapsnote";
			return false;
		}

		return $respuesta;

	}


	public function GET($url){


		$conexion = curl_init($url);

		if($conexion != false){

			curl_setopt($conexion, CURLOPT_URL,$url);

			//Petición GET
			curl_setopt($conexion, CURLOPT_HTTPGET, TRUE);

			//Cabecera HTTP
			curl_setopt($conexion, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));

			//Para recibir respuesta de la conexión
			curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);

			//Respuesta de la base de datos
			$respuesta = curl_exec($conexion);

			// Cierrar el recurso cURLy libera recursos del sistema
			curl_close($conexion);

			//Se guarda la información en un arreglo
			$decode = json_decode($respuesta, true);

			if( ($respuesta == false)||(strpos($respuesta,'Cannot GET') != false) ){
				$_SESSION['error'] = "ERROR la conexion a Trapsnote ha fallado";
				return false;
			}

		}
		else{
			$_SESSION['error'] = "ERROR no se pudo establecer conexion a Trapsnote";
			return false;
		}

		return $decode;

	}


	public function PATCH($datos, $url, $id){

		//Convierte el arreglo con todos los datos en un JSON
        $JSON = json_encode($datos);
 		//Crea un nuevo recurso cURL
		$conexion = curl_init($url);

		//Si no hubo ningún error, se procede a enviar los datos al servidor
        if($conexion != false){

			curl_setopt($conexion, CURLOPT_URL,$url);

			//Datos que se van a enviar por PATCH
			curl_setopt($conexion, CURLOPT_POSTFIELDS,$JSON);

			//Cabecera incluyendo la longitud de los datos de envio
			curl_setopt($conexion, CURLOPT_HTTPHEADER,array('Content-Type: application/json', 'Content-Length: '.strlen($JSON), $id));

			//Petición PATCH
			curl_setopt($conexion, CURLOPT_CUSTOMREQUEST, "PATCH");

			//Para que devuelva la respuesta
			curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);

			//HTTPGET a false porque no se trata de una petición GET
			curl_setopt($conexion, CURLOPT_HTTPGET, FALSE);

			//Respuesta
			$respuesta = curl_exec($conexion);

			curl_close($conexion);

			if($respuesta == ""){
				$_SESSION['error'] = "ERROR no se pudo modificar la tarea, intente mas tarde";
				return false;
			}

			return $respuesta;

		}
		else{
			$_SESSION['error'] = "ERROR no se pudo establecer conexion a Trapsnote";
			return false;
		}
	}


	public function DELETE($url){

		$conexion = curl_init($url);

		if($conexion != false){

			curl_setopt($conexion, CURLOPT_URL,$url);

			//Cabecera
			curl_setopt($conexion, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));

			//Petición DELETE
			curl_setopt($conexion, CURLOPT_CUSTOMREQUEST, "DELETE");

			//HTTPGET a false porque no se trata de una petición GET
			curl_setopt($conexion, CURLOPT_HTTPGET, FALSE);

			//Para que devuelva la respuesta
			curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);

			//Respuesta
			$respuesta = curl_exec($conexion);

			curl_close($conexion);

			//Se pueden presentar estos errores al hacer la solicitud
			if( ($respuesta == "")||(strpos($respuesta,'Cannot DELETE') != false) ){
				$_SESSION['error'] = "ERROR la conexion a Trapsnote ha fallado";
				return false;
			}

			return $respuesta;

		}
		else{
			$_SESSION['error'] = "ERROR no se pudo establecer conexion a Trapsnote";
			return false;
		}


	}


	public function PUT($url, $datos){

		//Convierte el arreglo con todos los datos en un JSON
        $JSON = json_encode($datos);

		$conexion = curl_init($url);

		if($conexion != false){

			curl_setopt($conexion, CURLOPT_URL,$url);

			//Datos que se van a enviar por PUT
			curl_setopt($conexion, CURLOPT_POSTFIELDS,$JSON);

			//Cabecera incluyendo la longitud de los datos de envio
			curl_setopt($conexion, CURLOPT_HTTPHEADER,array('Content-Type: application/json', 'Content-Length: '.strlen($JSON)));

			//Petición PUT
			curl_setopt($conexion, CURLOPT_CUSTOMREQUEST, "PUT");

			//HTTPGET a false porque no se trata de una petición GET
			curl_setopt($conexion, CURLOPT_HTTPGET, FALSE);

			//Para que devuelva la respuesta
			curl_setopt($conexion, CURLOPT_RETURNTRANSFER, 1);

			//Respuesta
			$respuesta = curl_exec($conexion);

			var_dump($respuesta);

			curl_close($conexion);

			//Se pueden presentar estos errores al hacer la solicitud
			if( ($respuesta == "")||(strpos($respuesta,'Cannot PUT') != false) ){
				$_SESSION['error'] = "ERROR la conexion a Trapsnote ha fallado";
				return false;
			}

			return $respuesta;

		}
		else{
			$_SESSION['error'] = "ERROR no se pudo establecer conexion a Trapsnote";
			return false;
		}

	}



	public function postNuevoUsuario($usuario){

    	//URL de la base de datos en Heroku
    	$url = 'https://dry-forest-40048.herokuapp.com/usuarios';

    	//Usa el recurso POST
 		$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    	$respuesta = $recurso->POST($usuario, $url);

		//No presenta fallas
		if($respuesta != false){
			$_SESSION['exito'] = "Se ha registrado con exito";
			return true;
		}

		//Se presentó algún error
		return false;

	}

	public function getCategorias(){

		@session_start();
		
		$nombres = array();

		$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
		$listaCategorias = $recurso->GET('https://dry-forest-40048.herokuapp.com/categorias');

		/*Se presentó alguna falla al hacer el GET*/
		if($listaCategorias != false){

			$listaDeCategorias = $listaCategorias['categorias'];

			foreach($listaDeCategorias as $categoria){
				$nombres[ $categoria['nombre'] ] = $categoria['nombre'];
			}

			return $nombres;

		}

		$_SESSION['error'] = "Se presento un error al cargar las categorias";
		return false;

	}


	public function getListaUsername(){

		//URL de la base de datos en Heroku
    	$url = 'https://dry-forest-40048.herokuapp.com/usuarios';

		//Usa el recurso GET
 		$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    	$respuesta = $recurso->GET($url);

    	if($respuesta != false){

    		$arrgloDeUsername = array();

        	foreach ($respuesta['usuarios'] as $valor) {
    			array_push($arrgloDeUsername, $valor['username']);
			}

			return $arrgloDeUsername;
		}

		@session_start();
		$_SESSION['error'] = "Problemas con la conexion a Trapsnote, intente mas tarde";

		return false;

	}


	public function getListaCorreo(){

    	//URL de la base de datos en Heroku
    	$url = 'https://dry-forest-40048.herokuapp.com/usuarios';

    	//Usa el recurso GET
 		$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    	$respuesta = $recurso->GET($url);

    	if($respuesta != false){

			$arrgloDeEmail = array();

        	foreach ($respuesta['usuarios'] as $valor) {
    			array_push($arrgloDeEmail, $valor['email']);
			}

			return $arrgloDeEmail;
		}

		@session_start();
		$_SESSION['error'] = "Problemas con la conexion a Trapsnote, intente mas tarde";

		return false;

	}


	public function postLogin($usuario){

    	//URL de la base de datos en Heroku
    	$url = 'https://dry-forest-40048.herokuapp.com/login';

    	//Usa el recurso POST
 		$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    	$respuesta = $recurso->POST($usuario, $url);

    	if($respuesta != false){

			//Se concatena para que al capturar el error no devuelva 0 (false) al encontrar el error
			$errores = "." . $respuesta;

			if( (strpos($errores,'{"errormsg":"Contraseña incorrecta"}')) != false){
				$_SESSION['error'] = "Contraseña incorrecta";
				return false;
			}

			if( (strpos($errores,'{"errormsg":"El usuario no existe"}')) != false){
				$_SESSION['error'] = "El Usuario NO existe";
				return false;
			}

			if( (strpos($errores,'{"errormsg":"Su usuario se encuentra bloqueado"}')) != false){
				$_SESSION['error'] = "Ese Usuario se encuentra BLOQUEADO";
				return false;
			}

			$usuario = json_decode($respuesta, true);
			$nombre = $usuario['username'];

			@session_start();

			//------- VARIABLES GLOBALES ------

			$_SESSION['username'] = $usuario['username'];
			$_SESSION['url'] = "https://dry-forest-40048.herokuapp.com/$nombre/"."tareas";
			//Se le pasa a la vista el link generado

			$_SESSION['name'] = $usuario['name'];
			$_SESSION['last_name'] = $usuario['last_name'];
			$_SESSION['menu'] = 0;

			/*Se devuelve +02:00 o -02:00 (Diferencia con la hora de Greenwich [GMT]). En nuestro caso (Venezuela) es -04:00*/
			$diferencia = date("P");
			$signo = substr($diferencia, 0, 1);

			$horaSinSigno = substr($diferencia, 1, 2);
			$minutoSinSigno = substr($diferencia, 4);

			/*Si es una hora negativa*/
			if($signo == '-'){
				$_SESSION['horaMostrar'] = "- ".$horaSinSigno." hours - ".$minutoSinSigno." minutes";
				$_SESSION['horaEnviar'] = "+ ".$horaSinSigno." hours + ".$minutoSinSigno." minutes";
			}
			else{
				$_SESSION['horaMostrar'] = "+ ".$horaSinSigno." hours + ".$minutoSinSigno." minutes";
				$_SESSION['horaEnviar'] = "- ".$horaSinSigno." hours - ".$minutoSinSigno." minutes";
			}

			//Fue exitoso el inicio de sesión
			return true;
		}

		return false;

	}


	public function postNuevaTarea($tarea){

		@session_start();

		//URL de la base de datos en Heroku
    	$url = $_SESSION['url'];

    	//Usa el recurso POST
 		$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    	$respuesta = $recurso->POST($tarea, $url);

		if($respuesta != false){
	        $_SESSION['exito'] = "La tarea fue agregada exitosamente";
	        return true;
		}
		return false;

	}



	public function getTarea(){

		//Usa el recurso GET
 		$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    	$respuesta = $recurso->GET($_SESSION['url']);

		if($respuesta != false){
			$_SESSION['tareas'] = $respuesta['tareas'];
	        return $respuesta['tareas'];
		}

		return false;

	}


	public function getTareaID($id){

		//Usa el recurso GET
 		$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    	$respuesta = $recurso->getTarea();

    	if($respuesta != false){
	    	foreach ($respuesta as $tareas) {
	    		if ($tareas['_id'] == $id){
	    			return $tareas;
	    		}
	    	}
    	}

    	return false;

	}


	public function patchTarea($tarea){

		@session_start();

		//URL de la base de datos en Heroku
    	$url = $_SESSION['url'] . "/" . $_SESSION['id'];

		//Usa el recurso PATCH
 		$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    	$respuesta = $recurso->PATCH($tarea, $url, $_SESSION['id']);

    	if($respuesta == false){
    		$_SESSION['error'] = "La tarea no se puede modificar en este momento, por favor intente mas tarde";
    		return false;
    	}

    	//Se concatena para que al capturar el error no devuelva 0 (false) al encontrar el error
		$errores = "." . $respuesta;

    	if( (strpos($errores,'{"errormsg":"La tarea ya ha sido completada"}')) != false){
			$_SESSION['error'] = "No se permite modificar. La tarea ya fue completada";
			return false;
		}

    	$_SESSION['exito'] = "La tarea fue modificada exitosamente";
    	return true;

	}


	public function postEditarUsuario($edicion){

		@session_start();

		$url = "https://dry-forest-40048.herokuapp.com/usuarios/".$_SESSION['username'];

		$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    	$respuesta = $recurso->PATCH($edicion, $url, $_SESSION['username']);

		if($respuesta != false){
	        $_SESSION['exito'] = "El usuario fue modificado exitosamente";
					$usuario = json_decode($respuesta, true);
					$_SESSION['name'] = $edicion['name'];
					$_SESSION['last_name'] = $edicion['last_name'];
	        return true;
		}

		return false;

	}


	public function deleteTarea(){

		@session_start();

		$url = $_SESSION['url']."/".$_SESSION['id'];

		$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    	$respuesta = $recurso->DELETE($url);

    	//Se presento algún error
    	if($respuesta == false){
    		$_SESSION['error'] = $_SESSION['error'].". No se puede eliminar la tarea en este momento";
    		return false;
    	}

    	$respuesta = $recurso->getTareaID($_SESSION['id']);

    	if($respuesta == false){
	    	$_SESSION['exito'] = "La tarea fue eliminada con exito";
	    	$_SESSION['error'] = "";
    	}


	}


	public function putCompletado($datos){

		@session_start();

		$url = $_SESSION['url']."/".$_SESSION['id'];

		$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    	$respuesta = $recurso->PUT($url, $datos);

    	if($respuesta == false)
    		$_SESSION['error'] = $_SESSION['error'].". No se pudo completar la tarea";

	}


}
