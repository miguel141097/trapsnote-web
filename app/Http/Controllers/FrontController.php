<?php

namespace trapsnoteWeb\Http\Controllers;

use Illuminate\Http\Request;

//Se importa las reglas de validación del formulario
use trapsnoteWeb\Http\Requests\CrearTareaRequest;

class FrontController extends Controller
{

    public function mostrarTarea(){

    	return view('app.tareas');

    }


    public function manejarEventoCrearTarea(CrearTareaRequest $request){

		//Recibe el url mandado en la vista
		$urltarea = $request['url'];

		$arregloDeTarea = array('descripcion' => $request['descripcion'],'categoria'=>$request['categoria'], 'username' =>$request['username'], 'completado'=>$request['completado'],'horaCompletado'=>$request['horaCompletado'], 'fechaRegistro'=>$request['fechaRegistro']);

		//Esta clase maneja el envio de los datos por parte del usuario
    	$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    	$recurso->postNuevaTarea($arregloDeTarea, $urltarea);

	}



}