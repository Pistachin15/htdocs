@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-4">
        {{-- Imagen de la película --}}
        <img src="{{ $pelicula->poster }}" style="height:200px"/>
    </div>
    
    <div class="col-sm-8">
        {{-- Datos de la película --}}
        <h2>{{ $pelicula->title }}</h2>
        <p><strong>Año:</strong> {{ $pelicula->year }}</p>
        <p><strong>Director:</strong> {{ $pelicula->director }}</p>
        <p><strong>Resumen:</strong> {{ $pelicula->synopsis }}</p>
        
        <p><strong>Estado:</strong> 
            @if ($pelicula->rented)
                <span style="color: red;">Película actualmente alquilada</span>
            @else
                <span style="color: green;">Película disponible</span>
            @endif
        </p>

        {{-- Botones alineados en la misma línea --}}
        <div class="mt-3 d-flex flex-row flex-wrap gap-2 align-items-center">
            @if ($pelicula->rented)
                <form method="POST" action="{{ url('/catalog/return/' . $pelicula->id) }}" class="m-0">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">Devolver película</button>
                </form>
            @else
                <form method="POST" action="{{ url('/catalog/rent/' . $pelicula->id) }}" class="m-0">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Alquilar película</button>
                </form>
            @endif

            <a href="{{ url('/catalog/edit/'.$pelicula->id) }}" class="btn btn-warning">Editar película</a>
            <a href="{{ url('/catalog') }}" class="btn btn-secondary">Volver al listado</a>
        </div>
    </div>
</div>

@endsection