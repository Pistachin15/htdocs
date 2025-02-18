<?php
session_start();
require_once '../login.php';

$conn = new mysqli($hn, $un, $pw, $db, 3307);
if ($conn->connect_error) die("Error en la conexión.");

$sql = "SELECT id_usu FROM usuario WHERE nombre = '$'";

if (isset($_POST['tipoComida']) && isset($_POST['glucosaAntes']) && isset($_POST['glucosaDespues']) && isset($_POST['racionesComida']) && isset($_POST['insulina'])) {
    $tipoComida = $_POST['tipoComida'];
    $glucosaAntes = $_POST['glucosaAntes'];
    $glucosaDespues = $_POST['glucosaDespues'];
    $raciones = $_POST['racionesComida']; // Usé 'racionesComida' ya que en el formulario es el nombre del campo
    $insulina = $_POST['insulina'];
    $fecha = date("Y-m-d");

}

if (isset($_POST['condicion'])) {
    $condicion = $_POST['condicion']; //Esta sentencia de momento no hace falta
    // Si hay algún otro campo relacionado con la condición (hipoglucemia o hiperglucemia), puedes agregarlo aquí
    if ($condicion == 'hiperglucemia' && isset($_POST['glucosahipo']) && isset($_POST['correcion'])) {
        $glucosahipo = $_POST['glucosahipo'];
        $correcion = $_POST['correcion'];
    }

    if ($condicion == 'hipoglucemia' && isset($_POST['glucosahiper']) && isset($_POST['hora'])) {
        $glucosahiper = $_POST['glucosahiper'];
        $hora = $_POST['hora'];
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
    <script>
        // Función para mostrar u ocultar el formulario adicional basado en la selección
        function mostrarFormularioCondicion() {
            var condicion = document.getElementById("condicion").value;
            var formularioHiper = document.getElementById("formularioHiper");
            var formularioHipo = document.getElementById("formularioHipo");
            
            if (condicion === "hiperglucemia") {
                formularioHiper.style.display = "block"; // Muestra el formulario de hiperglucemia
            } else {
                formularioHiper.style.display = "none"; // Oculta el formulario de hiperglucemia
            }

            if (condicion === 'hipoglucemia') {
                formularioHipo.style.display = "block"; // Muestra el formulario de hipoglucemia
            } else {
                formularioHipo.style.display = "none"; // Oculta el formulario de hipoglucemia
            }
        }
    </script>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="bg-white p-5 rounded shadow w-75">
        <h3 class="text-center mb-4">Registro de Glucosa y Comida</h3>

        <form action="#" method="POST">
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
                <input type="number" id="glucosaAntes" name="glucosaAntes" class="form-control" required>
            </div>

            <!-- Glucosa 2 horas después -->
            <div class="mb-3">
                <label for="glucosaDespues" class="form-label">Glucosa 2 horas después de alimentarse (mg/dL)</label>
                <input type="number" id="glucosaDespues" name="glucosaDespues" class="form-control" required>
            </div>

            <!-- Raciones de comida -->
            <div class="mb-3">
                <label for="racionesComida" class="form-label">Raciones de comida que comiste</label>
                <input type="number" id="racionesComida" name="racionesComida" class="form-control" required>
            </div>

            <!-- Insulina suministrada -->
            <div class="mb-3">
                <label for="insulina" class="form-label">Insulina suministrada (U)</label>
                <input type="number" id="insulina" name="insulina" class="form-control" required>
            </div>

            <!-- Desplegable para elegir hipoglucemia o hiperglucemia -->
            <div class="mb-3">
                <label for="condicion" class="form-label">Condición</label>
                <select id="condicion" name="condicion" class="form-select" onchange="mostrarFormularioCondicion()">
                    <option value="">Seleccionar condición...</option>
                    <option value="hipoglucemia">Hipoglucemia</option>
                    <option value="hiperglucemia">Hiperglucemia</option>
                    <option value="ninguna">Ninguna</option>
                </select>
            </div>

            <!-- Formulario adicional para Hipoglucemia -->
            <div id="formularioHiper" style="display: none;">
                <div class="mb-3">
                    <label for="glucosahipo" class="form-label">Glucosa</label>
                    <input type="number" id="glucosahipo" name="glucosahipo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="glucosahipo" class="form-label">Correción</label>
                    <input type="number" id="correcion" name="correcion" class="form-control" required>
                </div>
                <div class="mb-3">               
                <label for="hora">Selecciona la hora (formato 24 horas):</label>
                <input type="time" id="hora" name="hora">
                </div>
            </div>

            <!-- Formulario adicional para Hipoglucemia -->
            <div id="formularioHipo" style="display: none;">
                <div class="mb-3">
                    <label for="glucosahiper" class="form-label">Glucosa</label>
                    <input type="number" id="glucosahiper" name="glucosahiper" class="form-control">
                </div>
                <div class="mb-3">               
                <label for="hora">Selecciona la hora (formato 24 horas):</label>
                <input type="time" id="horahipo" name="hora" >
                </div>
            </div>

            <!-- Botón para enviar el formulario -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
            <div class="d-flex justify-content-center">
            <a href="../Inicio/menuControl.php" class="btn btn-secondary">Volver</a>
            </div>

        </form>
    </div>

</body>
</html>
