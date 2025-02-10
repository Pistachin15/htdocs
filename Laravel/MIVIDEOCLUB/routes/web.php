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

Route::get('/', function () {
    //return view('welcome');
    echo "Hola mundo";
});


Route::get('pagina1', function () {
    //return view('welcome');
    echo "Estas en la pagina 1";
});

Route::get('pagina2/{id}', function ($id) {
    return "usuario";
});

