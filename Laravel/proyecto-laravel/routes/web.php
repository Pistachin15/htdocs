<?php

use App\Http\Controllers\PictogramaController;

use App\Http\Controllers\AgendaController;

Route::get('/pictogramas', [PictogramaController::class, 'index'])->name('pictogramas.index');
Route::get('/agenda/create', [AgendaController::class, 'create'])->name('agenda.create');
Route::post('/agenda/store', [AgendaController::class, 'store'])->name('agenda.store');
Route::get('/agenda/consultar', [AgendaController::class, 'consultar'])->name('agenda.consultar');
Route::post('/agenda/mostrar', [AgendaController::class, 'mostrar'])->name('agenda.mostrar');
Route::get('/agenda/buscar', [AgendaController::class, 'buscar'])->name('agenda.buscar');

?>