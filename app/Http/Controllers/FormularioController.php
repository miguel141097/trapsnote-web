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

    //La variable request contiene TODOS los valores ingresados por el usuario en el formulario
    public function manejarEventoCrearSesion(UserCreateRequest $request){

        //Concatena la fecha
        $fechaDeNacimiento = $request['year'] . '/' . $request['month'] . '/' . $request['day']; 

        $arregloConDatosDelUsuario = array( 'username'=>$request['username'],'name' => $request['name'], 'last_name' => $request['last_name'],'email' => $request['email'], 'password' => $request['password'],'password_repeat' => $request['password_repeat'], 'fechaDeNacimiento' => $fechaDeNacimiento);

        //Esta clase maneja el envio de los datos por parte del usuario
        $recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
        $recurso->sendPostNuevoUsuario($arregloConDatosDelUsuario);

    }


}
