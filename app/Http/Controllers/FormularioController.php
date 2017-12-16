<?php

namespace trapsnoteWeb\Http\Controllers;

use Illuminate\Http\Request;

//Se importa las reglas de validación del formulario
use trapsnoteWeb\Http\Requests\UserCreateRequest;


class FormularioController extends Controller
{


    public function mostrarFormularioSingIn(){

    	return view('formulario.formularioSingIn');

    }
    public function mostrarFormularioLogin(){
      return view('formulario.formularioLogin');
    }

    //La variable request contiene TODOS los valores ingresados por el usuario en el formulario
    public function manejarEventoCrearSesion(UserCreateRequest $request){

    	$arregloConDatosDelUsuario = array( 'username'=>$request['username'],'name' => $request['name'], 'last_name' => $request['last_name'],'email' => $request['email'], 'password' => $request['password'],'password_repeat' => $request['password_repeat'] );

    	//Convierte el arreglo con todos los datos en un JSON
    	$JSON = json_encode($arregloConDatosDelUsuario);

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
			echo "<br> Hubo problemas al enviar los datos al servidor";
		}


    }

    public function manejarEventoLogin(UserLoginRequest $request){
      $arregloConDatosDelUsuario = array('email' => $request['email'], 'password' => $request['password']);

    	//Convierte el arreglo con todos los datos en un JSON
    	$JSON = json_encode($arregloConDatosDelUsuario);

    	//URL de la base de datos en Heroku
    	$url = 'https://dry-forest-40048.herokuapp.com/login';

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

			echo "<br> Datos enviados exitosamente ";

		}
		else{
			echo "<br> Hubo problemas al enviar los datos al servidor";
		}
    }


}
