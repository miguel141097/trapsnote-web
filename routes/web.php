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

//Estos controladores manejan la app luego de registrar e iniciar sesión

Route::get('Tarea', 'FrontController@mostrarTarea');

Route::get('Tarea/Nueva', 'FrontController@crearTarea');
Route::post('Tarea/Nueva', 'FrontController@manejarEventoCrearTarea');

Route::get('Tarea/Editar', 'FrontController@mostrarDetalles');
Route::post('Tarea/Editar', 'FrontController@manejarEventoEditarTarea');