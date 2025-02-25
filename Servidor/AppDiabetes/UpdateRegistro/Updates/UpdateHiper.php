<?php
session_start();
require_once '../../login.php'; // Archivo con credenciales de conexión a la base de datos
$conn = new mysqli($hn, $un, $pw, $db, $conn);

if ($conn->connect_error) die("Fatal Error");

if(isset($_POST['Enviar'])) {

    $fechaRecogida = $_POST['fecha_control'];
    $tipoComida = $_POST['tipoComida'];
    $correccion = $_POST['correccion'];
    $glucosaHiper = $_POST['glucosahiper'];
    $horaHiper = $_POST['horahiper'];
    
    // Obtener el id del usuario
    $nombreUsu = $_SESSION['nombreUsu'];
    $consultaId = "SELECT id_usu FROM usuario WHERE usuario = '$nombreUsu'"; //Consulta para recoger el id del usuario
    $resultado = $conn->query($consultaId); //Ejecutamos la consulta y lo almacenamos en una variable
    $fila = $resultado->fetch_assoc(); //Adelanto 1 posicion del array (-1 a 0) y almaceno lam fila en la variable
    $idUsuario = $fila['id_usu']; //Almacenamos el id de la columan id_usu en una variable 


    // Verificar si ya existe un registro para el usuario en la fecha actual
    $consultaVerificar = "SELECT COUNT(*) as total FROM hiperglucemia WHERE fecha = '$fechaRecogida' AND id_usu = '$idUsuario' AND tipo_comida = '$tipoComida'";
    $resultadoVerificar = $conn->query($consultaVerificar);
    $filaVerificar = $resultadoVerificar->fetch_assoc();

    if ($filaVerificar['total'] != 0) {
        // Si hay registros, actualiza los datos
        $actualizarHiper = "UPDATE hiperglucemia SET correccion = '$correccion', hora = '$horaHiper', glucosa = '$glucosaHiper' WHERE id_usu = '$idUsuario' AND fecha = '$fechaRecogida' AND tipo_comida = '$tipoComida'";

        if ($conn->query($actualizarHiper) === TRUE) {
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
    <title>Actualizado de Hiperglucemia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="bg-white p-5 rounded shadow w-25">
        <h3 class="text-center mb-4">Actualizacion de Hiperglucemia</h3>
        <?php if (!empty($actualizarCompletada)) echo $actualizarCompletada; ?>
        <?php if (!empty($mensajeError)) echo $mensajeError; ?>
        <form action="UpdateHiper.php" method="post">
            <!-- Seleccion de fecha -->
            <div class="mb-3">
                <label for="fecha">Fecha a modificar datos</label>
                <input type="date" id="fecha_control" name="fecha_control" required>
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
            <!-- Formulario adicional para Hiperglucemia -->
            <div class="mb-3">
                <label for="glucosahiper" class="form-label">Glucosa</label>
                <input type="number" id="glucosahiper" name="glucosahiper" class="form-control">
            </div>
            <div class="mb-3">
                <label for="correccion" class="form-label">Correción</label>
                <input type="number" id="correccion" name="correccion" class="form-control">
            </div>
            <div class="mb-3">               
                <label for="hora">Selecciona la hora (formato 24 horas):</label>
                <input type="time" id="horahiper" name="horahiper">
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