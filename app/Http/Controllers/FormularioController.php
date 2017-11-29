<?php

namespace trapsnoteWeb\Http\Controllers;

use Illuminate\Http\Request;

class FormularioController extends Controller
{
    

    public function mostrarFormularioSingIn(){

    	return view('formulario/formularioSingIn');

    }



}
