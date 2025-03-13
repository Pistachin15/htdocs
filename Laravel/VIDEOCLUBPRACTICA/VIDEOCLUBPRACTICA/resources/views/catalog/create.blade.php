@extends('layouts.master')

@section('content')
<h2>Agregar Nueva Película</h2>

<form action="{{ url('/catalog') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="title">Título:</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="year">Año:</label>
        <input type="number" name="year" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="director">Director:</label>
        <input type="text" name="director" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="poster">URL del Poster:</label>
        <input type="text" name="poster" class="form-control">
    </div>

    <div class="form-group">
        <label for="synopsis">Resumen:</label>
        <textarea name="synopsis" class="form-control" required></textarea>
    </div>

    <button type="submit" class="btn btn-success mt-3">Guardar Película</button>
    <a href="{{ url('/catalog') }}" class="btn btn-secondary mt-3">Cancelar</a>
</form>
@endsection