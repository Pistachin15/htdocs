@extends('layouts.app')

@section('content')
    <h1>Agenda del Día</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>Hora</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($agenda as $item)
                <tr>
                    <td>{{ $item->hora }}</td>
                    <td>
                        <img src="{{ asset('imagenes/' . $item->imagen) }}" width="100">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('agenda.buscar') }}">Volver</a>
@endsection
