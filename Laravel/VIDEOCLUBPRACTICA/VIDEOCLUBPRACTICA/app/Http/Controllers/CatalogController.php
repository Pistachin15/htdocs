<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peliculas;

class CatalogController extends Controller
{
    private $arrayPeliculas;

    public function __construct()
    {
       
    }

    public function getIndex()
    {
        $peliculas = Peliculas::all();
    
        return view('catalog.index', compact('peliculas'));
    }
    
    public function getShow($id)
    {
        $pelicula = Peliculas::findOrFail($id);

        return view('catalog.show', compact('pelicula', 'id'));
    }

    public function getCreate()
    {
        return view('catalog.create');
    }
    
    public function getEdit($id)
    {
        $pelicula = Peliculas::findOrFail($id);

        return view('catalog.edit', compact('pelicula'));
    }
    
    public function postCreate(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'year' => 'required',
            'director' => 'required',
            'poster' => 'required',
            'synopsis' => 'required',
        ]);

        Peliculas::create([
            'title' => $request->input('title'),
            'year' => $request->input('year'),
            'director' => $request->input('director'),
            'poster' => $request->input('poster'),
            'synopsis' => $request->input('synopsis'),
        ]);

        return redirect()->route('catalog.index');
    }

    public function postEdit(Request $request, $id)
    {
        $pelicula = Peliculas::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'year' => 'required',
            'director' => 'required',
            'poster' => 'required',
            'synopsis' => 'required',
        ]);

        $pelicula->update([
            'title' => $request->input('title'),
            'year' => $request->input('year'),
            'director' => $request->input('director'),
            'poster' => $request->input('poster'),
            'synopsis' => $request->input('synopsis'),
        ]);

        return redirect()->route('catalog.index');
    }

    public function store(Request $request)
    {
        $pelicula = new Peliculas();

        $pelicula->title = $request->input('title');
        $pelicula->year = $request->input('year');
        $pelicula->director = $request->input('director');
        $pelicula->poster = $request->input('poster');
        $pelicula->synopsis = $request->input('synopsis');
        $pelicula->rented = false;

        $pelicula->save();

        return redirect('/catalog')->with('success', 'Película creada correctamente');
    }

    public function update(Request $request, $id)
    {
        $pelicula = Peliculas::findOrFail($id);

        $pelicula->title = $request->input('title');
        $pelicula->year = $request->input('year');
        $pelicula->director = $request->input('director');
        $pelicula->poster = $request->input('poster');
        $pelicula->synopsis = $request->input('synopsis');
        $pelicula->rented = $request->input('rented') ? true : false;

        $pelicula->save();

        return redirect('/catalog/show/'.$pelicula->id)->with('success', 'Película actualizada correctamente.');
    }

    public function putRent($id)
    {
        $pelicula = Peliculas::findOrFail($id);
        $pelicula->rented = true;
        $pelicula->save();

        return redirect()->back()->with('success', 'Película alquilada correctamente.');
    }

    public function putReturn($id)
    {
        $pelicula = Peliculas::findOrFail($id);
        $pelicula->rented = false;
        $pelicula->save();

        return redirect()->back()->with('success', 'Película devuelta correctamente.');
    }

    public function delete($id)
    {
        $pelicula = Peliculas::findOrFail($id);
        $pelicula->delete();

        return redirect('/catalog')->with('success', 'Película eliminada correctamente');
    }
}