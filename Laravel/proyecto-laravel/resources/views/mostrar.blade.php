@extends('layouts.app')

@section('content')
    <h1>Agenda del Día</h1>

    @if($agenda->isEmpty())
        <p>No hay registros para esta fecha y persona.</p>
    @else
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
                        <td><img src="{{ asset($item->imagen) }}" width="100"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
