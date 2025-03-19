<?php
namespace App\Http\Controllers;

use App\Models\Imagen;

class PictogramaController extends Controller
{
    public function index()
    {
        $imagenes = Imagen::all();

        return view('pictogramas.index', compact('imagenes'));
    }
}
