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
			// Cierrar el recurso cURLy libera recursos del sistema
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


	public function PATCH($datos, $url){

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
			curl_setopt($conexion, CURLOPT_HTTPHEADER,array('Content-Type: application/json', 'Content-Length: '.strlen($JSON), "id" => $_SESSION['id']));

			//Petición PATCH
			curl_setopt($conexion, CURLOPT_CUSTOMREQUEST, "PATCH");
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

	public function getCategorias(){
		$nombres = array();
		$listaCategorias = $recurso->GET('https://dry-forest-40048.herokuapp.com/categorias');
		$listaDeCategorias = $listaCategorias['categorias'];
		foreach($listaDeCategorias as $categoria){
		$nombres[] = $categoria['nombre'];
		}
		sort($nombres);

		@session_start();
		$_SESSION['categorias'] = $nombres;

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

			$usuario = json_decode($respuesta, true);
			$nombre = $usuario['username'];

			@session_start();

			//Variables globales
			$_SESSION['username'] = $usuario['username'];
			$_SESSION['url'] = "https://dry-forest-40048.herokuapp.com/$nombre/"."tareas";
			$_SESSION['name'] = $usuario['name'];
			$_SESSION['last_name'] = $usuario['last_name'];
			//Se le pasa a la vista el link generado

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

    	foreach ($respuesta as $tareas) {
    		if ($tareas['_id'] == $id){
    			return $tareas;
    		}
    	}
    	$_SESSION['error'] = "La tarea no se puede modificar en este momento, por favor intente mas tarde";
    	return false;

	}


	public function patchTarea($tarea){

		@session_start();

		//URL de la base de datos en Heroku
    	$url = $_SESSION['url'] . "/" . $_SESSION['id'];

		//Usa el recurso PATCH
 		$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    	$respuesta = $recurso->PATCH($tarea, $url);

    	if($respuesta == false)
    		return false;

    	$_SESSION['exito'] = "La tarea fue modificada exitosamente";
    	return true;

	}

	public function postEditarUsuario($edicion, $url){


		$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    $respuesta = $recurso->PATCH($edicion, $url);

		if($respuesta != false){
	        $_SESSION['exito'] = "El usuario fue modificado exitosamente";
	        return true;
		}
		return false;
		/*
		$JSONEU = json_encode($edicion);
		$ch2 = curl_init($url);

		if($ch2 != false){
					curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch2, CURLOPT_CUSTOMREQUEST, 'PATCH');
	        curl_setopt($ch2, CURLOPT_POSTFIELDS, $JSONEU);
	        curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	        $response = curl_exec($ch2);
	        curl_close($ch2);
					var_dump ($response);
		}
		else
			echo "Lo sentimos la tarea no se pudo enviar al servidor";*/
	}


}
