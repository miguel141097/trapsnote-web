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

Route::get('SignUp','FormularioController@mostrarFormularioSignUp');
Route::get('Login', 'FormularioController@mostrarFormularioLogin');
Route::get('Login/tarea', 'FormularioController@mostrarTareas');

//Es necesario colocar el post para manejar el boton submit
Route::post('SignUp','FormularioController@manejarEventoCrearSesion');
Route::post('Login', 'FormularioController@manejarEventoLogin');
//tareas
Route::post('Login/tarea', ['as' => 'Login/tarea', 'uses' => 'FormularioController@manejarCrearTarea']);
