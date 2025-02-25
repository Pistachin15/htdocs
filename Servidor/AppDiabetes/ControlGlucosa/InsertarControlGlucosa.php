<?php
session_start();
require_once '../login.php'; // Archivo con credenciales de conexión a la base de datos
$conn = new mysqli($hn, $un, $pw, $db, $conn);

if ($conn->connect_error) die("Fatal Error");




if(isset($_POST['Enviar'])) {

    $nombreUsu = $_SESSION['nombreUsu'];
    
    // Obtener el id del usuario
    $consultaId = "SELECT id_usu FROM usuario WHERE usuario = '$nombreUsu'";
    $resultado = $conn->query($consultaId);
    $fila = $resultado->fetch_assoc();
    $idUsuario = $fila['id_usu'];  

    $fecha = date("Y-m-d");
    $lenta = $_POST['InsulinaLenta'];
    $actividad = $_POST['Actividad'];

    // Verificar si ya existe un registro para el usuario en la fecha actual
    $consultaVerificar = "SELECT COUNT(*) as total FROM control_glucosa WHERE fecha = '$fecha' AND id_usu = '$idUsuario'";
    $resultadoVerificar = $conn->query($consultaVerificar);
    $filaVerificar = $resultadoVerificar->fetch_assoc();

    if ($filaVerificar['total'] == 0) {
        // Si no hay registros, insertar los datos
        $insertControlGlucosa = "INSERT INTO control_glucosa (fecha, deporte, lenta, id_usu) VALUES ('$fecha', '$actividad', '$lenta', '$idUsuario')";

        if ($conn->query($insertControlGlucosa) === TRUE) {
            $insercionCompletada = '<div class="alert alert-warning text-center mt-3" role="alert">
            Datos registrados correctamente.
            </div>';
        }
    } else {
        // Si ya hay un registro, mostrar un mensaje de error
        $mensajeError = '<div class="alert alert-warning text-center mt-3" role="alert">
        Ya insertaste el control de hoy.
        </div>';
    }
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Control de Glucosa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 w-25">
        <div class="card p-4 shadow-sm">
            <?php if (!empty($insercionCompletada)) echo $insercionCompletada; ?>
            <?php if (!empty($mensajeError)) echo $mensajeError; ?>
            <h2 class="mb-4">Control de Glucosa</h2>
            <form id="glucoseForm" action="InsertarControlGlucosa.php" method="post">
                <div class="mb-3">
                    <label for="InsulinaLenta" class="form-label">Insulina lenta</label>
                    <input type="number" class="form-control" id="InsulinaLenta" name="InsulinaLenta" placeholder="Cantidad administrada de insulina lenta" min="1" max="70" required>
                    <div class="invalid-feedback">Debe ser un número entre 1 y 70.</div>
                </div>
                <div class="mb-3">
                    <label for="Actividad" class="form-label">Actividad</label>
                    <input type="number" class="form-control" id="Actividad" name="Actividad" placeholder="Nivel de actividad (1-5)" min="1" max="5" required>
                    <div class="invalid-feedback">Debe ser un número entre 1 y 5.</div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" name="Enviar" class="btn btn-primary">Enviar</button>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="../Inicio/menuControl.php" class="btn btn-secondary mt-2">Volver</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("glucoseForm").addEventListener("submit", function(event) {
            let isValid = true;

            // Validación Insulina Lenta
            let insulina = document.getElementById("InsulinaLenta");
            let insulinaValue = parseInt(insulina.value);
            if (isNaN(insulinaValue) || insulinaValue < 1 || insulinaValue > 70) {
                insulina.classList.add("is-invalid");
                isValid = false;
            } else {
                insulina.classList.remove("is-invalid");
            }

            // Validación Actividad
            let actividad = document.getElementById("Actividad");
            let actividadValue = parseInt(actividad.value);
            if (isNaN(actividadValue) || actividadValue < 1 || actividadValue > 5) {
                actividad.classList.add("is-invalid");
                isValid = false;
            } else {
                actividad.classList.remove("is-invalid");
            }

            // Si hay errores, prevenir envío
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
