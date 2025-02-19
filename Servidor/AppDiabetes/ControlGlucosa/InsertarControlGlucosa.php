<?php
session_start();
require_once '../login.php'; // Archivo con credenciales de conexión a la base de datos
$conn = new mysqli($hn, $un, $pw, $db, 3307);

if ($conn->connect_error) die("Fatal Error");




if(isset($_POST['Enviar'])){

    $nombreUsu = $_SESSION['nombreUsu'];
    $consultaId = "SELECT id_usu FROM usuario WHERE usuario = '$nombreUsu'";
    $resultado = $conn->query($consultaId);  //Se ejecuta la consulta
    $fila = $resultado->fetch_assoc(); //Extrae la primera fila devuelta por la consulta en forma de array asociativo
    $idUsuario = $fila['id_usu'];  //Almacenamos en la variable idUsuario el id dentro de id_usu
    $fecha = date("Y-m-d");
    $lenta = $_POST['InsulinaLenta'];
    $actividad = $_POST['Actividad'];


    $insertControlGlucosa = "INSERT into control_glucosa (fecha, deporte, lenta, id_usu) VALUES ('$fecha', '$actividad', '$lenta', '$idUsuario')";

    if ($conn->query($insertControlGlucosa) === TRUE) {
        $insercionCompletada = '<div class="alert alert-warning text-center mt-3" role="alert">
        Datos registrados correctamente.
     </div>';
        
    } else {
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
    <title>Formulario Bootstrap 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 w-25">
        <div class="card p-4 shadow-sm">
             <?php if (!empty($insercionCompletada)) echo $insercionCompletada; ?>
             <?php if (!empty($mensajeError)) echo $mensajeError; ?>
            <h2 class="mb-4">Control de Glucosa</h2>
            <form action="InsertarControlGlucosa.php" method="post">
                <div class="mb-3">
                    <label for="Insulina lenta" class="form-label">Insulina lenta</label>
                    <input type="text" class="form-control" id="InsulinaLenta" name="InsulinaLenta"  placeholder="Cantidad administrada de insulina lenta" required>
                </div>
                <div class="mb-3">
                    <label for="Actividad" class="form-label">Actividad</label>
                    <input type="text" class="form-control" id="Actividad" name="Actividad" placeholder="Deporte" required>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>