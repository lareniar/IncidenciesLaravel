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

//importar todas las rutas por defecto de laravel y poner register como inaccesible
Auth::routes(['register' => false, 'login'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

// google login
Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

// rutas incidencias
Route::get('/home/incidencias', 'IncidenciasController@incidencias');
Route::post('/home/incidencias', 'IncidenciasController@eliminarIncidencia');

// rutas incidencias ver
Route::get('/home/incidencias/ver/{id}', 'IncidenciasController@verIncidencia');

// rutas incidencias crear
Route::get('/home/incidencias/crear', 'IncidenciasController@form');
Route::post('/home/incidencias/crear', 'IncidenciasController@crearIncidencia');

// rutas incidencias editar
Route::get('/home/incidencias/{id}', 'IncidenciasController@editarIncidencia');
Route::post('/home/incidencias/{id}', 'IncidenciasController@updateIncidencia');


