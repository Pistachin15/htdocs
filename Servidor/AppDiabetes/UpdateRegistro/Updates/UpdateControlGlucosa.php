<?php
session_start();
require_once '../../login.php'; // Archivo con credenciales de conexión a la base de datos
$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) die("Fatal Error");

if(isset($_POST['Enviar'])) {

    $fechaRecogida = $_POST['fecha_control'];
    $lenta = $_POST['InsulinaLenta'];
    $actividad = $_POST['Actividad'];
    
    // Obtener el id del usuario
    $nombreUsu = $_SESSION['nombreUsu'];
    $consultaId = "SELECT id_usu FROM usuario WHERE usuario = '$nombreUsu'"; //Consulta para recoger el id del usuario
    $resultado = $conn->query($consultaId); //Ejecutamos la consulta y lo almacenamos en una variable
    $fila = $resultado->fetch_assoc(); //Adelanto 1 posicion del array (-1 a 0) y almaceno lam fila en la variable
    $idUsuario = $fila['id_usu']; //Almacenamos el id de la columan id_usu en una variable 


    // Verificar si ya existe un registro para el usuario en la fecha actual
    $consultaVerificar = "SELECT COUNT(*) as total FROM control_glucosa WHERE fecha = '$fechaRecogida' AND id_usu = '$idUsuario'";
    $resultadoVerificar = $conn->query($consultaVerificar);
    $filaVerificar = $resultadoVerificar->fetch_assoc();

    if ($filaVerificar['total'] != 0) {
        // Si hay registros, actualiza los datos
        $actualizarControlGlucosa = "UPDATE control_glucosa SET lenta = '$lenta', deporte = '$actividad' WHERE id_usu = '$idUsuario' AND fecha = '$fechaRecogida'";

        if ($conn->query($actualizarControlGlucosa) === TRUE) {
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
    <title>Actualizado de Control de Glucosa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 w-25">
        <div class="card p-4 shadow-sm">
            <h2 class="mb-4">Actualizacion del Control de Glucosa</h2>
            <?php if (!empty($actualizarCompletada)) echo $actualizarCompletada; ?>
            <?php if (!empty($mensajeError)) echo $mensajeError; ?>
            <form action="UpdateControlGlucosa.php" method="post">
                 <div class="mb-3">
                    <label for="fecha">Fecha a modificar datos</label>
                    <input type="date" id="fecha_control" name="fecha_control" required>
                </div>
                <div class="mb-3">
                    <label for="Insulina lenta" class="form-label">Insulina lenta</label>
                    <input type="text" class="form-control" id="InsulinaLenta" name="InsulinaLenta"  placeholder="Cantidad administrada de insulina lenta" required>
                </div>
                <div class="mb-3">
                    <label for="Actividad" class="form-label">Actividad</label>
                    <input type="text" class="form-control" id="Actividad" name="Actividad" placeholder="Deporte" required>
                </div>
                <div class="d-flex justify-content-center">
                <button type="submit" name="Enviar" class="btn btn-primary">Actualizar</button>
                </div>

                <div class="d-flex justify-content-center">
                    <a href="../MenuUpdate.html" class="btn btn-secondary mt-2">Volver</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>