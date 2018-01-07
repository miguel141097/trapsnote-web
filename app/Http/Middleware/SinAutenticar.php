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

        if( isset($_SESSION['username']) )
            return $next($request);

        return redirect()->action('FormularioController@mostrarFormularioLogin');            
        
    }

}
