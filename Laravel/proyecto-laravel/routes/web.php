<?php

use App\Http\Controllers\PictogramaController;

use App\Http\Controllers\AgendaController;

Route::get('/pictogramas', [PictogramaController::class, 'index'])->name('pictogramas.index');
Route::get('/agenda/create', [AgendaController::class, 'create'])->name('agenda.create');
Route::post('/agenda/store', [AgendaController::class, 'store'])->name('agenda.store');
?>