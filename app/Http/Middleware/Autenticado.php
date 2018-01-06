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
     public function handle($request, Closure $next){
        @session_start();
          if($_SESSION!=NULL)
              return redirect()->action('FrontController@mostrarLogout');

         return $next($request);
     }
}
