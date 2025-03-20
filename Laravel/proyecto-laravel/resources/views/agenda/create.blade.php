@extends('layouts.app')

@section('content')
    <h1>Añadir Entrada en la Agenda</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('agenda.store') }}" method="POST">
        @csrf

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" required>

        <label for="hora">Hora:</label>
        <input type="time" name="hora" required>

        <label for="persona">Persona:</label>
        <select name="idpersona" required>
            @foreach($personas as $persona)
                <option value="{{ $persona->id }}">{{ $persona->nombre }}</option>
            @endforeach
        </select>

        <label>Selecciona una imagen:</label>

        <table border="1">
            <thead>
                <tr>
                    <th>Seleccionar</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                @foreach($imagenes as $imagen)
                    <tr>
                        <td>
                            <input type="radio" name="imagen_id" value="{{ $imagen->id }}" required>
                        </td>
                        <td>
                            <img src="{{ asset('imagenes/' . $imagen->imagen) }}" alt="{{ $imagen->nombre }}" width="100">
                        </td>
                        <td>{{ $imagen->nombre }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit">Añadir entrada en agenda</button>
    </form>
@endsection
