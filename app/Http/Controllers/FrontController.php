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
    $error = false;
    if($request['fecha'] == "SI"){

      @session_start();
      //Concatena la fecha
      $fechaLimite = $request['year'] . '-' . $request['month'] . '-' . $request['day']. 'T' . $request['hour'] . ':' . $request['minute'];
      $fechaParaEnviar = $fechaLimite." ".$_SESSION['horaEnviar'];
      $fechaParaEnviar = date('Y-m-d H:i:s', strtotime($fechaParaEnviar));
      if( strtotime($fechaParaEnviar) <= strtotime(gmdate('Y-m-d H:i:s')) ){
        $_SESSION['error'] = "No se permite modificar. La fecha limite debe ser mayor a la fecha actual";
        $error = true;
      }

    }
    else
      $fechaParaEnviar = null;
    if($error == false){
      $arregloDeTarea = array( 'nombre' => $request['nombre'], 'descripcion' => $request['descripcion'],'categoria'=>$request['categoria'], 'username' =>$request['username'], 'fechaLimite' => $fechaParaEnviar );
      //Usa el recurso PATCH
      $recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
      $respuesta = $recurso->patchTarea($arregloDeTarea);
      if( ($respuesta != false) && ($request['completado'] == true) ){
        $completado = array('completado' => $request['completado']);
        $recurso->putCompletado($completado);
      }
    }
    return redirect()->action('FrontController@mostrarTarea');
  }


    public function crearTarea(){

        return view('app.nuevaTarea');

    }


    public function manejarEventoCrearTarea(CrearTareaRequest $request){
   if($request['fecha'] == "SI"){

     @session_start();
     //Concatena la fecha
     $fechaLimite = $request['year'] . '-' . $request['month'] . '-' . $request['day']. 'T' . $request['hour'] . ':' . $request['minute'];
     $fechaParaEnviar = $fechaLimite." ".$_SESSION['horaEnviar'];
     $fechaParaEnviar = date('Y-m-d H:i:s', strtotime($fechaParaEnviar));
     if( strtotime($fechaParaEnviar) <= strtotime(gmdate('Y-m-d H:i:s')) ){
       $_SESSION['error'] = "No se permite modificar. La fecha limite debe ser mayor a la fecha actual";
       return false;
     }
   }
   else
     $fechaParaEnviar = null;
   $arregloDeTarea = array( 'nombre' => $request['nombre'], 'descripcion' => $request['descripcion'],'categoria'=>$request['categoria'], 'username' =>$request['username'], 'fechaLimite' => $fechaParaEnviar );
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

    public function mostrarSesionCerrada(){

        return view('app.sesionCerrada');

    }

  public function manejarEventoLogout(){

    $recurso = new \trapsnoteWeb\Libreria\RecursoHTTP();
    $respuesta=  $recurso->DeleteLogout();
    if($respuesta!= NULL){

      //separa el header para obtener el status de la respuesta del servidor
      $porciones = explode("HTTP/1.1", $respuesta);
      $status=explode(" ", $porciones[1]);

        //si es 200 define que no hubo problema en cerrar sesion
          if($status[1]==200){
            @session_start();
            $_SESSION=array();
            //destruye sesion
            @session_destroy();
            //elimina los cookie de este sitio
            @setcookie();

              return redirect()->action('FrontController@mostrarSesionCerrada');
          }
          else{
              //no se pudo cerrar sesion correctamente
              $_SESSION['error']="NO se pudo cerrar sesion correctamente";
              return  redirect()->action('FrontController@mostrarLogout');
          }
    }
    else{
      $_SESSION['error']="Fallo la conexion a Trapsnote";
      return  redirect()->action('FrontController@mostrarLogout');
    }
    }




  }
