<?php

namespace trapsnoteWeb\Http\Controllers;

use Illuminate\Http\Request;

//Se importa las reglas de validación del formulario
use trapsnoteWeb\Http\Requests\CrearTareaRequest;
use trapsnoteWeb\Http\Requests\EditarUsuario;

class FrontController extends Controller
{

    public function mostrarTarea(){

    	return view('app.tareas');

    }

    public function mostrarEditarPerfil(){
      return view('app.editarPerfil');
    }


    public function manejarEventoCrearTarea(CrearTareaRequest $request){

		//Recibe el url mandado en la vista
		$urltarea = $request['url'];

		$arregloDeTarea = array('descripcion' => $request['descripcion'],'categoria'=>$request['categoria'], 'username' =>$request['username'], 'completado'=>$request['completado'],'horaCompletado'=>$request['horaCompletado'], 'fechaRegistro'=>$request['fechaRegistro']);

		//Esta clase maneja el envio de los datos por parte del usuario
    	$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    	$recurso->postNuevaTarea($arregloDeTarea, $urltarea);

	}

  public function manejarEventoEditarPerfil(EditarUsuario $request){
    session_start();
    $urledicion = "https://dry-forest-40048.herokuapp.com/usuarios/".$_SESSION['username'];
    $arregloEdicion = array('name' => $request['name'], 'last_name' => $request['last_name'], 'password' => $request['password']);
    $recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    $recurso->postEditarUsuario($arregloEdicion, $urledicion);

  }



}
