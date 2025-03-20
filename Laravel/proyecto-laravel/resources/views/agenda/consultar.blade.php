@extends('layouts.app')

@section('content')
    <h1>Consultar Agenda</h1>

    <form action="{{ route('agenda.mostrar') }}" method="POST">
        @csrf

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" required>

        <label for="idpersona">ID Persona:</label>
        <select name="idpersona" required>
            @foreach($personas as $persona)
                <option value="{{ $persona->idpersona }}">{{ $persona->idpersona }}</option>
            @endforeach
        </select>

        <button type="submit">Mostrar Agenda</button>
    </form>
@endsection
