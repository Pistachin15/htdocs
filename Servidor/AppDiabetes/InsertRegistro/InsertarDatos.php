<?php
session_start();
require_once '../login.php';

$nombreUsu = $_SESSION['nombreUsu'];

$conn = new mysqli($hn, $un, $pw, $db, $conn);
if ($conn->connect_error) die("Error en la conexión.");

$consultaId = "SELECT id_usu FROM usuario WHERE usuario = '$nombreUsu'";
$resultado = $conn->query($consultaId);
$fila = $resultado->fetch_assoc();
$idUsuario = $fila['id_usu'];

if (isset($_POST['Enviar'])) {
    $tipoComida = $_POST['tipoComida'];
    $glucosaAntes = $_POST['glucosaAntes'];
    $glucosaDespues = $_POST['glucosaDespues'];
    $raciones = $_POST['racionesComida']; 
    $insulina = $_POST['insulina'];
    $fecha = date("Y-m-d");

    $validarComida = "SELECT id_usu FROM comida WHERE tipo_comida = '$tipoComida' AND fecha = '$fecha' AND id_usu = $idUsuario";
    $resultadoValidacion = $conn->query($validarComida);

    if ($resultadoValidacion->num_rows > 0) {
        $mensajeError = '<div class="alert alert-warning text-center mt-3" role="alert">
        Ya insertaste esta comida de hoy.
        </div>';

    } else {

        $insertarComida = "INSERT INTO comida (tipo_comida, gl_1h, gl_2h, raciones, insulina, fecha, id_usu) 
                           VALUES ('$tipoComida', '$glucosaAntes', '$glucosaDespues', '$raciones', '$insulina', '$fecha', $idUsuario)";


        $verificarComida = "SELECT COUNT(*) as total FROM control_glucosa WHERE fecha = '$fecha' AND id_usu = '$idUsuario' ";
        $resultadoVerificarComida = $conn->query($verificarComida);
        $filaVerificarComida = $resultadoVerificarComida->fetch_assoc();

                           

        if ($filaVerificarComida['total'] != 0 && $conn->query($insertarComida) === TRUE) {

            if ($_POST['condicion'] == 'hiperglucemia') {
                $correccion = $_POST['correccion'];
                $glucosaHiper = $_POST['glucosahiper'];
                $horaHiper = $_POST['horahiper'];
                $insertarHiper = "INSERT INTO hiperglucemia (glucosa, hora, id_usu, fecha, correccion, tipo_comida) 
                                  VALUES ('$glucosaHiper', '$horaHiper', $idUsuario, '$fecha', '$correccion', '$tipoComida')";
                $conn->query($insertarHiper);
            }

            elseif ($_POST['condicion'] == 'hipoglucemia') {
                $glucosaHipo = $_POST['glucosahipo'];
                $horaHipo = $_POST['horahipo'];
                $insertarHipo = "INSERT INTO hipoglucemia (glucosa, hora, id_usu, fecha, tipo_comida) 
                                 VALUES ('$glucosaHipo', '$horaHipo', $idUsuario, '$fecha', '$tipoComida')";
                $conn->query($insertarHipo);

            }

            
            $insercionCompletada = '<div class="alert alert-warning text-center mt-3" role="alert">
            Datos registrados correctamente.
            </div>';
        } else {
            $sinControlGlucosa = '<div class="alert alert-warning text-center mt-3" role="alert">
            Inserta antes un control de glucosa.
            </div>';
        }
    }
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Glucosa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="bg-white p-5 rounded shadow w-25">
        <h3 class="text-center mb-4">Registro de Glucosa y Comida</h3>
        <?php if (!empty($insercionCompletada)) echo $insercionCompletada; ?>
        <?php if (!empty($mensajeError)) echo $mensajeError; ?>
        <?php if (!empty($sinControlGlucosa)) echo $sinControlGlucosa; ?>
        <form action="InsertarDatos.php" method="post" onsubmit="return validarFormulario()">
        <!-- Selección de comida -->
            <div class="mb-3">
                <label for="tipoComida" class="form-label">Selecciona el tipo de comida</label>
                <select id="tipoComida" name="tipoComida" class="form-select" required>
                    <option value="">Seleccionar...</option>
                    <option value="desayuno">Desayuno</option>
                    <option value="almuerzo">Almuerzo</option>
                    <option value="comida">Comida</option>
                    <option value="merienda">Merienda</option>
                    <option value="cena">Cena</option>
                </select>
            </div>

            <!-- Glucosa 1 hora antes -->
            <div class="mb-3">
                <label for="glucosaAntes" class="form-label">Glucosa 1 hora antes de alimentarse (mg/dL)</label>
                <input type="number" id="glucosaAntes" name="glucosaAntes" class="form-control" min="70" max="150" required>
            </div>

            <!-- Glucosa 2 horas después -->
            <div class="mb-3">
                <label for="glucosaDespues" class="form-label">Glucosa 2 horas después de alimentarse (mg/dL)</label>
                <input type="number" id="glucosaDespues" name="glucosaDespues" class="form-control" min="90" max="180" required>
            </div>

            <!-- Raciones de comida -->
            <div class="mb-3">
                <label for="racionesComida" class="form-label">Raciones de comida que comiste</label>
                <input type="number" id="racionesComida" name="racionesComida" class="form-control" max="20" required>
            </div>

            <!-- Insulina suministrada -->
            <div class="mb-3">
                <label for="insulina" class="form-label">Insulina suministrada (U)</label>
                <input type="number" id="insulina" name="insulina" class="form-control" min="1" max="50" required>
            </div>

            <!-- Botones para elegir hipoglucemia o hiperglucemia -->
            <div class="mb-3">
                <label for="condicion" class="form-label">Condición</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="hipoglucemia" name="condicion" value="hipoglucemia" onclick="mostrarFormularioCondicion()">
                    <label class="form-check-label" for="hipoglucemia">Hipoglucemia</label>
                </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="hiperglucemia" name="condicion" value="hiperglucemia" onclick="mostrarFormularioCondicion()">
                <label class="form-check-label" for="hiperglucemia">Hiperglucemia</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="ninguna" name="condicion" value="ninguna" onclick="mostrarFormularioCondicion()">
            <label class="form-check-label" for="ninguna">Ninguna</label>
            </div>
            </div>

            <!-- Formulario adicional para Hiperglucemia -->
            <div id="formularioHiper" style="display: none;">
                <div class="mb-3">
                    <label for="glucosahiper" class="form-label">Glucosa</label>
                    <input type="number" id="glucosahiper" name="glucosahiper" min="180" max="600" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="correccion" class="form-label">Correción</label>
                    <input type="number" id="correccion" name="correccion" max ="50" class="form-control">
                </div>
                <div class="mb-3">               
                    <label for="hora">Selecciona la hora (formato 24 horas):</label>
                    <input type="time" id="horahiper" name="horahiper">
                </div>
            </div>

            <!-- Formulario adicional para Hipoglucemia -->
            <div id="formularioHipo" style="display: none;">
                <div class="mb-3">
                    <label for="glucosahipo" class="form-label">Glucosa</label>
                    <input type="number" id="glucosahipo" name="glucosahipo" min="55" max="100" class="form-control">
                </div>
                <div class="mb-3">               
                    <label for="hora">Selecciona la hora (formato 24 horas):</label>
                    <input type="time" id="horahipo" name="horahipo">
                </div>
            </div>

            <!-- Botón para enviar el formulario -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" id="Enviar" name="Enviar">Enviar</button>
            </div>
            <div class="d-flex justify-content-center">
            <a href="../Inicio/menuControl.php" class="btn btn-secondary mt-2">Volver</a>
            </div>

        </form>
    </div>
    <script>
function mostrarFormularioCondicion() {
    var condicion = document.querySelector('input[name="condicion"]:checked').value;

    document.getElementById("formularioHipo").style.display = "none";
    document.getElementById("formularioHiper").style.display = "none";

    document.getElementById("glucosahipo").required = false;
    document.getElementById("horahipo").required = false;
    document.getElementById("glucosahiper").required = false;
    document.getElementById("correccion").required = false;
    document.getElementById("horahiper").required = false;

    if (condicion === "hipoglucemia") {
        document.getElementById("formularioHipo").style.display = "block";
        document.getElementById("glucosahipo").required = true;
        document.getElementById("horahipo").required = true;
    } else if (condicion === "hiperglucemia") {
        document.getElementById("formularioHiper").style.display = "block";
        document.getElementById("glucosahiper").required = true;
        document.getElementById("correccion").required = true;
        document.getElementById("horahiper").required = true;
    }
}

    </script>
     <script>
    document.addEventListener("DOMContentLoaded", function () {
        const camposNumericos = document.querySelectorAll('input[type="number"]');
        
        camposNumericos.forEach(campo => {
            campo.setAttribute("min", "0"); 
            campo.addEventListener("input", function () {
                if (this.value < 0) {
                    this.value = "";
                    alert("No se permiten valores negativos.");
                }
            });
        });
    });
    </script>
    <script>
function validarFormulario() {
    // Verificar si al menos un radio button está seleccionado
    if (!document.querySelector('input[name="condicion"]:checked')) {
        alert("Por favor, selecciona una opción de condición (Hipoglucemia, Hiperglucemia o Ninguna).");
        return false; // Evita que el formulario se envíe
    }
    // Si todo está bien, el formulario se puede enviar
    return true;
}
</script>


</body>
</html>

