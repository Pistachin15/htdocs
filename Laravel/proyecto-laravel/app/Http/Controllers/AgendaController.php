<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Agenda;
use App\Models\Imagen;

class AgendaController extends Controller
{
    // Mostrar el formulario de consulta
    public function consultar()
    {
        $personas = Persona::all(); // Obtener todas las personas
        return view('agenda.consultar', compact('personas'));
    }

    // Mostrar la agenda filtrada por fecha e idpersona
    public function mostrar(Request $request)
    {
        // Validación
        $request->validate([
            'fecha' => 'required|date',
            'idpersona' => 'required|exists:personas,idpersona',
        ]);

        // Consulta para obtener la agenda
        $agenda = Agenda::select('imagenes.imagen', 'agenda.fecha', 'agenda.hora')
            ->join('imagenes', 'imagenes.idimagen', '=', 'agenda.idimagen')
            ->where('agenda.idpersona', $request->idpersona)
            ->where('agenda.fecha', $request->fecha)
            ->get();

        return view('agenda.mostrar', compact('agenda', 'request'));
    }

    public function buscar(){
        
        return view('agenda.buscar');
}

}
