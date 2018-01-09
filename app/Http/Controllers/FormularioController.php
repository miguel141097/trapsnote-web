<?php

namespace trapsnoteWeb\Http\Controllers;

use Illuminate\Http\Request;

//Se importa las reglas de validación del formulario
use trapsnoteWeb\Http\Requests\UserCreateRequest;
use trapsnoteWeb\Http\Requests\UserLoginRequest;


class FormularioController extends Controller{


  public function mostrarFormularioSignUp(){

    return view('formulario.formularioSignUp');

  }

  public function mostrarFormularioLogin(){

    return view('formulario.formularioLogin');

  }

  //La variable request contiene TODOS los valores ingresados por el usuario en el formulario
  public function manejarEventoCrearSesion(UserCreateRequest $request){

    @session_start();
    $_SESSION['Middleware'] = false;

    if( (isset($_SESSION['falla'])) && ($_SESSION['falla'] == false) ){

      //Concatena la fecha
      $fechaDeNacimiento = $request['year'] . '/' . $request['month'] . '/' . $request['day'];

      $arregloConDatosDelUsuario = array( 'username'=> $request['username'], 'name' => $request['name'], 'last_name' => $request['last_name'], 'email' => $request['email'], 'password' => $request['password'], 'fechaDeNacimiento' => $fechaDeNacimiento, 'formaRegistro' => $request['formaRegistro'] );

      //Esta clase maneja el envio de los datos por parte del usuario
      $recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
      $respuesta = $recurso->postNuevoUsuario($arregloConDatosDelUsuario);

      //Redirecciona dependiendo de si fue exitoso o no
      if($respuesta == true)
        return redirect()->action('FormularioController@mostrarFormularioLogin');

    }

    return redirect()->action('FormularioController@mostrarFormularioSignUp');

  }


  public function manejarEventoLogin(UserLoginRequest $request){

    @session_start();
    $arregloConDatosDelUsuario = array('email' => $request['email'], 'password' => $request['password']);

    //Define que no hay sesion activa
    $_SESSION['Middleware'] = false;
    date_default_timezone_set($request['ZonaHoraria']);
    $_SESSION['ZonaHoraria'] = $request['ZonaHoraria'];

    $recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    $respuesta = $recurso->postLogin($arregloConDatosDelUsuario);

    //Redirecciona dependiendo de si fue exitoso o no
    if($respuesta == true){
      //Define que hay una sesion abierta para que el Middleware excluya
      $_SESSION['Middleware'] = true;
      return redirect()->action('FrontController@mostrarTarea');
    }

    else
      return redirect()->action('FormularioController@mostrarFormularioLogin');

  }

}
