<?php

use App\Http\Controllers\PictogramaController;

Route::get('/pictogramas', [PictogramaController::class, 'index'])->name('pictogramas.index');
?>