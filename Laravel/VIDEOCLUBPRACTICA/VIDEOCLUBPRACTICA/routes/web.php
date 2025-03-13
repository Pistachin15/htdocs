<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;

Route::get('/', [HomeController::class, 'getHome']);

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/logout', function () {
    return "Logout usuario";
});

Route::get('/catalog', [CatalogController::class, 'getIndex']);
Route::post('/catalog', [CatalogController::class, 'store']);
Route::get('/catalog/show/{id}', [CatalogController::class, 'getShow']);
Route::get('/catalog/create', [CatalogController::class, 'getCreate']);
Route::put('/catalog/update/{id}', [CatalogController::class, 'update']);
Route::delete('/catalog/delete/{id}', [CatalogController::class, 'delete']);
Route::get('/catalog/edit/{id}', [CatalogController::class, 'getEdit']);
Route::put('/catalog/edit/{id}', [CatalogController::class, 'putEdit']);
Route::put('/catalog/rent/{id}', [CatalogController::class, 'putRent']);
Route::put('/catalog/return/{id}', [CatalogController::class, 'putReturn']);
?>