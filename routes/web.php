<?php
use trapsnoteWeb\Http\Controllers\FrontController;
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

Route::get('SignUp','FormularioController@mostrarFormularioSignUp')->middleware(Autenticado::class);
Route::get('Login', 'FormularioController@mostrarFormularioLogin')->middleware(Autenticado::class);


//Es necesario colocar el post para manejar el boton submit
Route::post('SignUp','FormularioController@manejarEventoCrearSesion');
Route::post('Login', 'FormularioController@manejarEventoLogin');

//Estos controladores manejan la app luego de registrar e iniciar sesión

Route::get('Tarea', 'FrontController@mostrarTarea')->middleware(SinAutenticar::class);


Route::get('EditProfile','FrontController@mostrarEditarPerfil')->middleware(SinAutenticar::class);
Route::post('EditProfile', 'FrontController@manejarEventoEditarPerfil');

Route::get('Tarea/Nueva', 'FrontController@crearTarea')->middleware(SinAutenticar::class);
Route::post('Tarea/Nueva', 'FrontController@manejarEventoCrearTarea');

Route::get('Tarea/Editar', 'FrontController@mostrarDetalles')->middleware(SinAutenticar::class);
Route::post('Tarea/Editar', 'FrontController@manejarEventoEditarTarea');
Route::delete('Tarea/Editar', 'FrontController@manejarEventoEliminarTarea');


Route::get('logout', 'FrontController@mostrarLogout')->middleware(SinAutenticar::class);
Route::delete('logout', 'FrontController@manejarEventoLogout');
