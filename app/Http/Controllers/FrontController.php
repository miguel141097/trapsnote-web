<?php

namespace trapsnoteWeb\Http\Controllers;

use Illuminate\Http\Request;

//Se importa las reglas de validación del formulario
use trapsnoteWeb\Http\Requests\CrearTareaRequest;
use trapsnoteWeb\Http\Requests\EditarUsuario;

class FrontController extends Controller
{

    public function mostrarTarea(){

    	return view('app.getTarea');

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

            switch($request['categoria']){
              case 0:
                $request['categoria'] = 'Estudios';
                break;
              case 1:
                $request['categoria'] = 'Trabajo';
                break;
              case 2:
                $request['categoria'] = 'Hogar';
                break;
              case 3:
                $request['categoria'] = 'Actividad';
                break;
              case 4:
                $request['categoria'] = 'Ejercicio';
                break;
              case 5:
                $request['categoria'] = 'Plan';
                break;
              case 6:
                $request['categoria'] = 'Informacion';
                break;
            }

        $arregloDeTarea = array( 'nombre' => $request['nombre'], 'descripcion' => $request['descripcion'],'categoria'=>$request['categoria'], 'username' =>$request['username'], 'fechaLimite' => $fechaLimite );

        //Usa el recurso PATCH
        $recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
        $respuesta = $recurso->patchTarea($arregloDeTarea);

        if( ($respuesta != false) && ($request['completado'] == true) ){
            $completado = array('completado' => $request['completado']);
            $recurso->putCompletado($completado);
        }

        return redirect()->action('FrontController@mostrarTarea');

    }


    public function crearTarea(){

        return view('app.nuevaTarea');

    }


    public function manejarEventoCrearTarea(CrearTareaRequest $request){

        if($request['fecha'] == "SI"){
            //Concatena la fecha
            $fechaLimite = $request['year'] . '/' . $request['month'] . '/' . $request['day'];
        }
        else
            $fechaLimite = null;

        switch($request['categoria']){
          case 0:
            $request['categoria'] = 'Estudios';
            break;
          case 1:
            $request['categoria'] = 'Trabajo';
            break;
          case 2:
            $request['categoria'] = 'Hogar';
            break;
          case 3:
            $request['categoria'] = 'Actividad';
            break;
          case 4:
            $request['categoria'] = 'Ejercicio';
            break;
          case 5:
            $request['categoria'] = 'Plan';
            break;
          case 6:
            $request['categoria'] = 'Informacion';
            break;
        }

		$arregloDeTarea = array( 'nombre' => $request['nombre'], 'descripcion' => $request['descripcion'],'categoria'=>$request['categoria'], 'username' =>$request['username'], 'fechaLimite' => $fechaLimite );

		//Esta clase maneja el envio de los datos por parte del usuario
    	$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    	$respuesta = $recurso->postNuevaTarea($arregloDeTarea);

        if($respuesta == true)
            return redirect()->action('FrontController@mostrarTarea');
        else
            return redirect()->action('FormularioController@crearTarea');

	}


    public function mostrarEditarPerfil(){

      return view('app.editarPerfil');

    }


    public function manejarEventoEditarPerfil(EditarUsuario $request){

        $arregloEdicion = array('name' => $request['name'], 'last_name' => $request['last_name'], 'password' => $request['password']);

        $recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
        $respuesta = $recurso->postEditarUsuario($arregloEdicion);

        if ($respuesta == true)
            return redirect()->action('FrontController@mostrarTarea');
        else {
            return redirect()->action('FrontController@mostrarEditarPerfil');
        }

    }


    public function manejarEventoEliminarTarea(){

        $recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
        $recurso->deleteTarea();

        return redirect()->action('FrontController@mostrarTarea');

    }
    public function manejarEventoMenu(){
          session_start();
              if ($_SESSION['menu'] == 0){
                    $_SESSION['menu'] = 1;
              }
              else $_SESSION['menu'] = 0;
          return Redirect::back();
    }
    public function mostrarLogout(){

        return view('app.logout');

    }

  public function manejarEventoLogout(){

      //$recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
      //$recurso->logout();
      @session_start();
      $_SESSION=array();
      @session_destroy();
      @setcookie();
      echo "CERRO SESION CORRECTAMENTE";
  }



}
