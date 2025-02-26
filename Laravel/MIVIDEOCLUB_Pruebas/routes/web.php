<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas web para tu aplicación.
| Estas rutas son cargadas por el RouteServiceProvider dentro de un grupo
| que contiene el middleware "web". ¡Ahora crea algo increíble!
|
*/

// Ruta principal
Route::get('/', [HomeController::class, 'getHome']);

// Rutas del catálogo
Route::get('catalog', [CatalogController::class, 'getIndex']);
Route::get('catalog/show/{id}', [CatalogController::class, 'getShow']);
Route::get('catalog/create', [CatalogController::class, 'getCreate']);
Route::get('catalog/edit/{id}', [CatalogController::class, 'getEdit']);
