@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catálogo de Pictogramas</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <style>
    .table td {
      text-align: center;
      vertical-align: middle;
      padding: 20px;
    }
    .icon {
      font-size: 48px;
    }
    img {
      max-width: 100px;
      max-height: 100px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="text-center">Listado de Pictogramas</h1>
    <table class="table table-bordered">
      <tbody>
        @php $contador = 0; @endphp
        <tr>
        @foreach ($imagenes as $imagen)
          <td>
            @if (Str::startsWith($imagen->imagen, 'glyphicon'))
              <i class="{{ $imagen->imagen }} icon"></i>
            @else
              <img src="{{ asset('imagenes/' . trim($imagen->imagen)) }}" alt="{{ $imagen->descripcion }}">
              <div>{{ $imagen->imagen }}</div>
            @endif
          </td>
          @php $contador++; @endphp
          @if ($contador % 4 == 0)
            </tr><tr>
          @endif
        @endforeach
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>