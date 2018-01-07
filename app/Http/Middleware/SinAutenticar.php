<?php

namespace trapsnoteWeb\Http\Middleware;
use Closure;

class SinAutenticar {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        @session_start();
          if($_SESSION!=NULL){if (  $_SESSION['Middleware']== false)
                  return redirect()->action('FormularioController@mostrarFormularioLogin');
          }
          else
                  return redirect()->action('FormularioController@mostrarFormularioLogin');

        return $next($request);
    }
}
