<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
=======

>>>>>>> a550087ed7b37ead656cc21a46016328540ea8ed
Route::get('SingUp','FormularioController@mostrarFormularioSingIn');
Route::get('Login', 'FormularioController@mostrarFormularioLogin');

//Es necesario colocar el post para manejar el boton submit
Route::post('SingUp','FormularioController@manejarEventoCrearSesion');
Route::post('Login', 'FormularioController@manejarEventoLogin');

