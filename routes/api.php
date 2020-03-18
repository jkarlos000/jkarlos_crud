<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

/***
 * Libros
 */
Route::resource('libros', 'Libro\LibroController', ['only' => ['index', 'show']]);
Route::resource('libros.librerias', 'Libro\LibroLibreriaController', ['only' => ['index']]);//Retirar es totalmente innecesario
/***
 * Librerias
 */
Route::resource('librerias', 'Libreria\LibreriaController', ['except' => ['create', 'edit']]);
Route::resource('librerias.libros', 'Libreria\LibreriaLibroController', ['except' => ['create', 'show', 'edit']]);
