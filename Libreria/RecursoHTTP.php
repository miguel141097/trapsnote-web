<?php

namespace trapsnoteWeb\Libreria;

class RecursoHTTP{
protected $valor;
	public function sendPostNuevoUsuario($usuario){

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

public function setAtributo($valor){
	$this->valor=$valor;
}

public function getAtributo(){
	return $this->valor;
}

}
