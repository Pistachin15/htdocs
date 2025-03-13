@extends('layouts.master')

@section('content')
<div class="row">
    <div class="mb-4">
        <a href="{{ url('/catalog/create') }}" class="btn btn-primary">+ Nueva Película</a>
    </div>

    @foreach ($peliculas as $pelicula)
        <div>
            <h3>{{ $pelicula->title }}</h3>  
            <p>{{ $pelicula->year }} - {{ $pelicula->director }}</p>  
            <p>{{ $pelicula->synopsis }}</p>  
            <a href="{{ url('catalog/show/' . $pelicula->id) }}">Ver Detalles</a>
            <a href="{{ url('catalog/edit/' . $pelicula->id) }}">Editar</a>
        </div>
    @endforeach
</div>
@endsection