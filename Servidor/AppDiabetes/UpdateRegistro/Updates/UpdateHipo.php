<?php
session_start();
require_once '../../login.php'; // Archivo con credenciales de conexión a la base de datos
$conn = new mysqli($hn, $un, $pw, $db, $conn);

if ($conn->connect_error) die("Fatal Error");

if(isset($_POST['Enviar'])) {

    $fechaRecogida = $_POST['fecha_control'];
    $tipoComida = $_POST['tipoComida'];
    $glucosaHipo = $_POST['glucosahipo'];
    $horaHipo = $_POST['horahipo'];
    
    // Obtener el id del usuario
    $nombreUsu = $_SESSION['nombreUsu'];
    $consultaId = "SELECT id_usu FROM usuario WHERE usuario = '$nombreUsu'"; //Consulta para recoger el id del usuario
    $resultado = $conn->query($consultaId); //Ejecutamos la consulta y lo almacenamos en una variable
    $fila = $resultado->fetch_assoc(); //Adelanto 1 posicion del array (-1 a 0) y almaceno lam fila en la variable
    $idUsuario = $fila['id_usu']; //Almacenamos el id de la columan id_usu en una variable 


    // Verificar si ya existe un registro para el usuario en la fecha actual
    $consultaVerificar = "SELECT COUNT(*) as total FROM hipoglucemia WHERE fecha = '$fechaRecogida' AND id_usu = '$idUsuario' AND tipo_comida = '$tipoComida'";
    $resultadoVerificar = $conn->query($consultaVerificar);
    $filaVerificar = $resultadoVerificar->fetch_assoc();

    if ($filaVerificar['total'] != 0) {
        // Si hay registros, actualiza los datos
        $actualizarHipo = "UPDATE hipoglucemia SET hora = '$horaHipo', glucosa = '$glucosaHipo' WHERE id_usu = '$idUsuario' AND fecha = '$fechaRecogida' AND tipo_comida = '$tipoComida'";

        if ($conn->query($actualizarHipo) === TRUE) {
            $actualizarCompletada = '<div class="alert alert-warning text-center mt-3" role="alert">
            Datos actualizados correctamente.
            </div>';
        }
    } else {
        // Si ya hay un registro, mostrar un mensaje de error
        $mensajeError = '<div class="alert alert-warning text-center mt-3" role="alert">
        No hay datos que actualizar.
        </div>';
    }
    
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización de Hipoglucemia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="bg-white p-5 rounded shadow w-25">
        <h3 class="text-center mb-4">Actualización de Hipoglucemia</h3>
        <?php if (!empty($actualizarCompletada)) echo $actualizarCompletada; ?>
        <?php if (!empty($mensajeError)) echo $mensajeError; ?>
        <form action="UpdateHipo.php" method="post">
            
            <!-- Selección de fecha -->
            <div class="mb-3">
                <label for="fecha_control">Fecha a modificar datos</label>
                <input type="date" id="fecha_control" name="fecha_control" class="form-control" required>
            </div>

            <!-- Selección de comida -->
            <div class="mb-3">
                <label for="tipoComida" class="form-label">Selecciona el tipo de comida a modificar</label>
                <select id="tipoComida" name="tipoComida" class="form-select" required>
                    <option value="">Seleccionar...</option>
                    <option value="desayuno">Desayuno</option>
                    <option value="almuerzo">Almuerzo</option>
                    <option value="comida">Comida</option>
                    <option value="merienda">Merienda</option>
                    <option value="cena">Cena</option>
                </select>
            </div>

            <!-- Nivel de glucosa -->
            <div class="mb-3">
                <label for="glucosahipo" class="form-label">Nivel de glucosa (mg/dL)</label>
                <input type="number" id="glucosahipo" name="glucosahipo" class="form-control" min="55" max="100" required>
            </div>

            <!-- Hora de la medición -->
            <div class="mb-3">
                <label for="horahipo">Selecciona la hora (formato 24 horas):</label>
                <input type="time" id="horahipo" name="horahipo" class="form-control" required>
            </div>
            
            <!-- Botón para enviar el formulario -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" id="Enviar" name="Enviar">Actualizar</button>
            </div>
            <div class="d-flex justify-content-center">
                <a href="../MenuUpdate.html" class="btn btn-secondary mt-2">Volver</a>
            </div>

        </form>
    </div>

</body>
</html>
