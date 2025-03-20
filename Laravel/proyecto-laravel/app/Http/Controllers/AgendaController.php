<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Imagen;
use App\Models\Agenda;

class AgendaController extends Controller
{
    // Mostrar el formulario para crear una nueva entrada en la agenda
    public function create()
    {
        $personas = Persona::all(); // Obtener todas las personas
        $imagenes = Imagen::all(); // Obtener todas las imágenes

        return view('agenda.create', compact('personas', 'imagenes'));
    }

    // Guardar la nueva entrada en la agenda
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'idpersona' => 'required|exists:personas,idpersona',  // Asegúrate que el ID es válido
            'idimagen' => 'required|exists:imagenes,idimagen',  // Verifica que el ID de la imagen es válido
        ]);

        // Insertar los datos en la base de datos
    // Insertar los datos en la base de datos
    Agenda::create([
        'fecha' => $request->fecha,
        'hora' => $request->hora,
        'idpersona' => $request->idpersona,
        'idimagen' => $request->idimagen,
    ]);
        
        
        return redirect()->route('agenda.create')->with('success', 'Entrada añadida correctamente.');
    }
}
