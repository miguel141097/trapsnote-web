<?php

namespace trapsnoteWeb\Libreria;

class RecursoHTTP{


	public function postNuevoUsuario($usuario){

        //Convierte el arreglo con todos los datos en un JSON
        $JSON = json_encode($usuario);

    	//URL de la base de datos en Heroku
    	$url = 'https://dry-forest-40048.herokuapp.com/usuarios';

    	//Crea un nuevo recurso cURL
        $ch = curl_init($url);

        //Si no hubo ningún error, se procede a enviar los datos al servidor
        if($ch != false){

        	//Configuración del recurso cURL
	        curl_setopt($ch, CURLOPT_POST, 1);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $JSON);
	        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

	        // Captura la URL y envia a la base de datos
	        curl_exec($ch);

	        // Cierrar el recurso cURLy libera recursos del sistema
			curl_close($ch);

			echo "<br> Se ha registrado exitosamente ";

		}
		else{
			echo "<br> Hubo problemas al enviar el nuevo usuario al servidor";

		}

	}


	public function getListaUsername(){

    	//URL de la base de datos en Heroku
    	$url = 'https://dry-forest-40048.herokuapp.com/usuarios';

    	//Crea un nuevo recurso cURL
        $ch = curl_init($url);

        //Si no hubo ningún error, se procede a enviar los datos al servidor
        if($ch != false){

        	//Configuración del recurso cURL
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_URL,$url);

	        // Captura la URL y envia a la base de datos
	        $result = curl_exec($ch);

	        // Cierrar el recurso cURLy libera recursos del sistema
			curl_close($ch);

			$decode = json_decode($result, true);

			$arrgloDeUsername = array();

        	foreach ($decode['usuarios'] as $valor) {
    			array_push($arrgloDeUsername, $valor['username']);
			}

			return $arrgloDeUsername;

		}
		else{
			echo "<br> Hubo problemas al recibir los USERNAME del servidor";

		}

	}


	public function getListaCorreo(){

    	//URL de la base de datos en Heroku
    	$url = 'https://dry-forest-40048.herokuapp.com/usuarios';

    	//Crea un nuevo recurso cURL
        $ch = curl_init($url);

        //Si no hubo ningún error, se procede a enviar los datos al servidor
        if($ch != false){

        	//Configuración del recurso cURL
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_URL,$url);

	        // Captura la URL y envia a la base de datos
	        $result = curl_exec($ch);

	        // Cierrar el recurso cURLy libera recursos del sistema
			curl_close($ch);

			$decode = json_decode($result, true);

			$arrgloDeUsername = array();

        	foreach ($decode['usuarios'] as $valor) {
    			array_push($arrgloDeUsername, $valor['email']);
			}

			return $arrgloDeUsername;

		}
		else{
			echo "<br> Hubo problemas al recibir los EMAIL del servidor";
		}

	}


	public function postLogin($usuario){

		//Convierte el arreglo con todos los datos en un JSON
    	$JSON = json_encode($usuario);

    	//URL de la base de datos en Heroku
    	$url = 'https://dry-forest-40048.herokuapp.com/login';

    	//Crea un nuevo recurso cURL
        $ch = curl_init($url);

        //Si no hubo ningún error, se procede a enviar los datos al servidor
        if($ch != false){

        	//Configuración del recurso cURL
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $JSON);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

			// Captura la URL y envia a la base de datos
			$response = curl_exec($ch);
			$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

			$header = substr($response, 0, $header_size);
			$body = substr($response, $header_size);
			$claves = preg_split("/[\s,]+/", $body);

			$menos = substr($claves[1],12);
			$s  =substr($menos,-1);
			$menos= str_replace($s, "/", $menos);

			// Cerrar el recurso cURLy libera recursos del sistema
			curl_close($ch);

			//Se le pasa a la vista el link generado
			$urltarea ="https://dry-forest-40048.herokuapp.com/:$menos"."tareas";

			session_start();

    		//Variables globales
    		$_SESSION['username'] = $menos;
    		$_SESSION['url'] = $urltarea;

		}
		else{
			echo "<br> Hubo problemas al enviar los datos al servidor";
      		curl_close($ch);
		}

	}


	public function postNuevaTarea($tarea, $url){

		$JSONT = json_encode($tarea);

		//Crea un nuevo recurso cURL
		$ch2 = curl_init($url);

		//Si no hubo ningún error, se procede a enviar los datos al servidor
		if($ch2 != false){

	        curl_setopt($ch2, CURLOPT_POST, 1);
	        curl_setopt($ch2, CURLOPT_POSTFIELDS, $JSONT);
	        curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

	        curl_exec($ch2);
	        curl_close($ch2);

	        if($ch2)
	        	echo "<br> <br> La tarea fue agregada exitosamente";
	        else
	        	echo "Lo sentimos no se pudo agregar Correctamente";

		}
		else
			echo "Lo sentimos la tarea no se pudo enviar al servidor";

	}

	public function postEditarUsuario($edicion, $url){
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
			echo "Lo sentimos la tarea no se pudo enviar al servidor";
	}


}
