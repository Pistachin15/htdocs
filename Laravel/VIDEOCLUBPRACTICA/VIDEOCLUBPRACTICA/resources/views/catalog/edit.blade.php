@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-4">
            {{-- Imagen de la película --}}
            <img src="{{ $pelicula->poster }}" style="height:200px"/>
        </div>

        <div class="col-sm-8">
            {{-- Formulario para editar la película --}}
            <h2>Editar película: {{ $pelicula->title }}</h2>

            <form method="POST" action="{{ url('/catalog/update/' . $pelicula->id) }}">
                @csrf
                @method('PUT') {{-- Indicar que es un PUT para actualizar la película --}}

                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $pelicula->title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="year" class="form-label">Año</label>
                    <input type="number" class="form-control" id="year" name="year" value="{{ old('year', $pelicula->year) }}" required>
                </div>

                <div class="mb-3">
                    <label for="director" class="form-label">Director</label>
                    <input type="text" class="form-control" id="director" name="director" value="{{ old('director', $pelicula->director) }}" required>
                </div>

                <div class="mb-3">
                    <label for="synopsis" class="form-label">Resumen</label>
                    <textarea class="form-control" id="synopsis" name="synopsis" rows="4" required>{{ old('synopsis', $pelicula->synopsis) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="poster" class="form-label">Imagen (URL)</label>
                    <input type="text" class="form-control" id="poster" name="poster" value="{{ old('poster', $pelicula->poster) }}">
                </div>

                <div class="mb-3">
                    <label for="rented" class="form-label">¿Está alquilada?</label>
                    <select class="form-control" id="rented" name="rented">
                        <option value="1" @if($pelicula->rented) selected @endif>Alquilada</option>
                        <option value="0" @if(!$pelicula->rented) selected @endif>Disponible</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Actualizar película</button>
            </form>

            {{-- Formulario para eliminar la película --}}
            <form method="POST" action="{{ url('/catalog/delete/' . $pelicula->id) }}" class="mt-3" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta película?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar película</button>
            </form>

            <a href="{{ url('/catalog') }}" class="btn btn-secondary mt-3">Volver al listado</a>
        </div>
    </div>
@endsection