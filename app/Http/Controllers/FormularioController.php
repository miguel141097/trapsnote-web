<?php

namespace trapsnoteWeb\Http\Controllers;

use Illuminate\Http\Request;

class FormularioController extends Controller
{
    

    public function mostrarFormularioSingIn(){

    	return view('formulario.formularioSingIn');

    }

    //La variable request contiene TODOS los valores ingresados por el usuario en el formulario
    public function manejarEventoCrearSesion(Request $request){

    	$arregloConDatosDelUsuario = array( 'name' => $request['name'], 'last_name' => $request['last_name'],'email' => $request['email'], 'password' => $request['password'],'password_repeat' => $request['password_repeat'] );

    	$JSON = json_encode($arregloConDatosDelUsuario);

    	//Envio de datos a la base de datos
    	$url = 'https://dry-forest-40048.herokuapp.com/usuarios';
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $JSON);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);

        echo "<br> Se ha registrado exitosamente ";

    }



}
