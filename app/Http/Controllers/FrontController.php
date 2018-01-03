<?php

namespace trapsnoteWeb\Http\Controllers;

use Illuminate\Http\Request;

//Se importa las reglas de validación del formulario
use trapsnoteWeb\Http\Requests\CrearTareaRequest;

class FrontController extends Controller
{

    public function mostrarTarea(){

    	return view('app.getTarea');

    }

    public function crearTarea(){
        
    	return view('app.nuevaTarea');

    }

    public function mostrarDetalles(){

        return view('app.editarTarea');

    }


    public function manejarEventoEditarTarea(CrearTareaRequest $request){

        if($request['fecha'] == "SI"){
            //Concatena la fecha
            $fechaLimite = $request['year'] . '/' . $request['month'] . '/' . $request['day'];
        }
        else
            $fechaLimite = null;

        $arregloDeTarea = array( 'nombre' => $request['nombre'], 'descripcion' => $request['descripcion'],'categoria'=>$request['categoria'], 'username' =>$request['username'], 'fechaLimite' => $fechaLimite );

        //Usa el recurso PATCH
        $recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
        $respuesta = $recurso->patchTarea($arregloDeTarea);

        return redirect()->action('FrontController@mostrarTarea');

    }


    public function manejarEventoCrearTarea(CrearTareaRequest $request){

        if($request['fecha'] == "SI"){
            //Concatena la fecha
            $fechaLimite = $request['year'] . '/' . $request['month'] . '/' . $request['day'];
        }
        else
            $fechaLimite = null;

		$arregloDeTarea = array( 'nombre' => $request['nombre'], 'descripcion' => $request['descripcion'],'categoria'=>$request['categoria'], 'username' =>$request['username'], 'fechaLimite' => $fechaLimite );

		//Esta clase maneja el envio de los datos por parte del usuario
    	$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    	$respuesta = $recurso->postNuevaTarea($arregloDeTarea);

        if($respuesta == true)
            return redirect()->action('FrontController@mostrarTarea');
        else
            return redirect()->action('FormularioController@crearTarea');

	}

}
