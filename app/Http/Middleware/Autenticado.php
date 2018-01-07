<?php

namespace trapsnoteWeb\Http\Middleware;

use Closure;

class Autenticado
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     /*si se inicio sesion no permite que se intente iniciar con otra cuenta*/
     public function handle($request, Closure $next){
        @session_start();
          if($_SESSION !=NULL)
              if($_SESSION['Middleware']==true)
                    return redirect()->action('FrontController@mostrarLogout');

         return $next($request);
     }
}
