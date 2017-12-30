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

//Es necesario colocar el post para manejar el boton submit
Route::post('SignUp','FormularioController@manejarEventoCrearSesion');
Route::post('Login', 'FormularioController@manejarEventoLogin');

//Este controlador maneja la app luego de registrar e iniciar sesión
//mostrar las tareas
Route::get('Tarea', 'FrontController@mostrarTarea');
//mostrar la pantalla de crear tareas
Route::get('tarea/crear', 'FrontController@crearTarea');
Route::post('Tarea', 'FrontController@manejarEventoCrearTarea');
