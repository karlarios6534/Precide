<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\InicioController@index');
//funcion sin parametros
Route::get('/prueba', function () {
    return "hola";
});
//funcion con parametro
Route::get('/nombre/{nombre}', function($nombre) {
    return '<h1>Hola '.$nombre.'</h1>';
});
//funcion con parametro por defecto
Route::get('/nombre/{cliente?}', function ($cliente = 'Cliente general') {
    return '<h1>Bienvenido '.$cliente.' </h1>' ;
});
//funciones que redireccionan
Route::get('/ruta1', function () {
    return "<h1>Esta es la ruta 1</h1>";
})->name('rutan1');

Route::get('/ruta2', function () {
    return redirect()->route('rutan1');
});
//validar usuario 
Route::get('/usuario/{usuario}', function ($usuario) {
    return '<h1>Esta es la ruta '.$usuario.'</h1>';
})->where('usuario','[A-Za-z]+');

//vista pasando parametro
Route::get('/vista1', function () {
    return view('vista1',['nombre' => 'karla']);
});

Route::resource('/show','App\Http\Controllers\PatientController' );

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
//vista crud pacientes
Route::resource('patients','App\Http\Controllers\PatientController');

/*Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/patients', function () {
        return view('patients');
    })->name('patients');
});
*/