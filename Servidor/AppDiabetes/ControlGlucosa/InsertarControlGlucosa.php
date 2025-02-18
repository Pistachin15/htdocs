<?php
session_start();
require_once '../login.php';

$nombreUsu = $_SESSION['nombreUsu'];

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Error en la conexión.");

$consultaId = "SELECT id_usu FROM usuario WHERE usuario = '$nombreUsu'";
$resultado = $conn->query($consultaId);  //Se ejecuta la consulta
$fila = $resultado->fetch_assoc(); //Extrae la primera fila devuelta por la consulta en forma de array asociativo
$idUsuario = $fila['id_usu'];  //Almacenamos en la variable idUsuario el id dentro de id_usu


if (isset($_POST['tipoComida']) && isset($_POST['glucosaAntes']) && isset($_POST['glucosaDespues']) && isset($_POST['racionesComida']) && isset($_POST['insulina'])) {
    $tipoComida = $_POST['tipoComida'];
    $glucosaAntes = $_POST['glucosaAntes'];
    $glucosaDespues = $_POST['glucosaDespues'];
    $raciones = $_POST['racionesComida']; 
    $insulina = $_POST['insulina'];
    $fecha = date("Y-m-d");

    $insertarComida ="INSERT into comida (tipo_comida, gl_1h, gl_2h, raciones, insulina, fecha, id_usu) VALUES ('$tipoComida', '$glucosaAntes', '$glucosaDespues', '$raciones', '$insulina', '$fecha', $idUsuario)";

    if ($conn->query($insertarComida) === TRUE) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error al insertar los datos: " . $conn->error;
    }
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
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="bg-white p-5 rounded shadow w-25">
        <h3 class="text-center mb-4">Registro de Glucosa y Comida</h3>

        <form action="InsertarControLGlucosa.php" method="post">
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



            <!-- Botón para enviar el formulario -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
            <div class="d-flex justify-content-center">
            <a href="../Inicio/menuControl.php" class="btn btn-secondary mt-2">Volver</a>
            </div>

        </form>
    </div>

</body>
</html>
