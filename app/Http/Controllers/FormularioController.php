<?php

namespace trapsnoteWeb\Http\Controllers;

use Illuminate\Http\Request;

//Se importa las reglas de validación del formulario
use trapsnoteWeb\Http\Requests\UserCreateRequest;
use trapsnoteWeb\Http\Requests\UserLoginRequest;
use trapsnoteWeb\Http\Requests\CrearTareaRequest;


class FormularioController extends Controller {
  private $recurso;
public function __construct(){
 $this->recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();

}
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
    echo"<br> <br> <br> <br>";
  echo "BIENVENIDO SIR ".$menos;
      echo"<br> <br> <br> <br>";       echo"<br> <br> <br> <br>";
         $recurso->setAtributo($menos);
	        // Cerrar el recurso cURLy libera recursos del sistema
			    curl_close($ch);


//url 
         $this->urltarea ="https://dry-forest-40048.herokuapp.com/:$menos"."tareas";
           var_dump($this->urltarea);
             var_dump($this->urltarea);
               var_dump($this->urltarea);
        return view('formulario.formularioTarea');



         //Si da error 400 es que el usuario no existe

		}
		else{
			echo "<br> Hubo problemas al enviar los datos al servidor";
      curl_close($ch);
		}


  }


public function manejarCrearTarea(CrearTareaRequest $request){
//$urltarea=array('url'=>$request['url']);
$recurso->getAtributo() as $urltarea;
  $arregloContarea = array('descripcion' => $request['descripcion'],'categoria'=>$request['categoria'], 'username' =>$request['username'], 'completado'=>$request['completado'],'horaCompletado'=>$request['horaCompletado'], 'fechaRegistro'=>$request['fechaRegistro']);
//  var_dump($arregloContarea);
  //Convierte el arreglo con todos los datos en un JSON

  $JSONT = json_encode($arregloContarea);
  var_dump($urltarea);
  //Crea un nuevo recurso cURL
    $ch2 = curl_init( $urltarea);
    echo"<br> <br> <br> <br> <br> <br> <br> ";
echo $urltarea;
    //Si no hubo ningún error, se procede a enviar los datos al servidor
    if($ch2 != false){

      //Configuración del recurso cURL
      curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch2, CURLOPT_VERBOSE, 1);
      curl_setopt($ch2, CURLOPT_HEADER, 1);
      curl_setopt($ch2, CURLOPT_POST, 1);
      curl_setopt($ch2, CURLOPT_POSTFIELDS, $JSONT);
      curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

      }
      		 $bien=  curl_exec($ch2);
          curl_close($ch2);
          if($ch2)
          var_dump($urltarea);
          echo "JAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaa";
            var_dump($urltarea);

}

}
