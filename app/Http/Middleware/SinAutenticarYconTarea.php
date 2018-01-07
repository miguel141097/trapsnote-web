<?php

namespace trapsnoteWeb\Http\Middleware;

use Closure;

class SinAutenticarYconTarea
{
   /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        
        @session_start();

        if( !( isset($_SESSION['username']) ) )
            return redirect()->action('FormularioController@mostrarFormularioLogin');

        /*En caso de estar registrado y colocar como url Tarea/Editar*/
        $enlace = $_SERVER['REQUEST_URI'];
        if( strpos($enlace , '=') == false )
            return redirect()->action('FrontController@mostrarTarea');

        return $next($request);             
        
    }
     
}