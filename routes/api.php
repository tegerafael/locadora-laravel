<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('jwt.auth')->group(function() {
  Route::post('me', 'App\Http\Controllers\AuthController@me');
  Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
  Route::post('logout', 'App\Http\Controllers\AuthController@logout');
  Route::apiResource('marca', 'App\Http\Controllers\MarcaController');
  Route::apiResource('modelo', 'App\Http\Controllers\ModeloController');
  Route::apiResource('carro', 'App\Http\Controllers\CarroController');
  Route::apiResource('cliente', 'App\Http\Controllers\ClienteController');
  Route::apiResource('locacao', 'App\Http\Controllers\LocacaoController');
});

Route::post('login', 'App\Http\Controllers\AuthController@login');
