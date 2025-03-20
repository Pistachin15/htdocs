@extends('layouts.app')

@section('content')
    <h1>Añadir Entrada en la Agenda</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('agenda.store') }}" method="POST">
        @csrf

        <!-- Campo para la fecha -->
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" required>

        <!-- Campo para la hora -->
        <label for="hora">Hora:</label>
        <input type="time" name="hora" required>

        <!-- Selección de persona con ID -->
        <label for="persona">Selecciona una persona (ID):</label>
        <select name="idpersona" required>
            @foreach($personas as $persona)
                <option value="{{ $persona->idpersona }}">{{ $persona->idpersona }} - {{ $persona->nombre }} {{ $persona->apellidos }}</option>
            @endforeach
        </select>

        <!-- Selección de imagen -->
        <label>Selecciona una imagen:</label>
        <table border="1">
            <tbody>
                @php $contador = 0; @endphp
                @foreach($imagenes as $imagen)
                    @if($contador % 4 == 0)
                        <tr> {{-- Inicia una nueva fila cada 4 elementos --}}
                    @endif

                    <td style="text-align: center; padding: 10px;">
                        <label>
                            <input type="radio" name="idimagen" value="{{ $imagen->idimagen }}" required>
                            <br>
                            <img src="{{ asset('imagenes/' . $imagen->imagen) }}" alt="{{ $imagen->descripcion }}" width="100">
                            <br>
                            {{ $imagen->descripcion }}
                        </label>
                    </td>

                    @php $contador++; @endphp

                    @if($contador % 4 == 0)
                        </tr> {{-- Cierra la fila después de 4 elementos --}}
                    @endif
                @endforeach

                {{-- Cierra la última fila si no tiene exactamente 4 elementos --}}
                @if($contador % 4 != 0)
                    </tr>
                @endif
            </tbody>
        </table>

        <button type="submit">Añadir entrada en agenda</button>
    </form>
@endsection
