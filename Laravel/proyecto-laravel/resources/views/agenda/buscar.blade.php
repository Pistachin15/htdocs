@extends('layouts.app')

@section('content')
    <h1>Buscar Agenda</h1>

    <form action="{{ route('agenda.mostrar') }}" method="GET">
        @csrf

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" required>

        <label for="idpersona">ID Persona:</label>
        <input type="number" name="idpersona" required>

        <button type="submit">Mostrar Agenda</button>
    </form>
@endsection
