<?php
session_start();
require_once '../login.php';

$nombreUsu = $_SESSION['nombreUsu'];

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Error en la conexión.");

// Obtener el ID del usuario
$consultaId = "SELECT id_usu FROM usuario WHERE usuario = '$nombreUsu'";
$resultado = $conn->query($consultaId);
$fila = $resultado->fetch_assoc();
$idUsuario = $fila['id_usu'];

if (isset($_POST['Enviar'])) {
    // Obtener los datos del formulario
    $tipoComida = $_POST['tipoComida'];
    $glucosaAntes = $_POST['glucosaAntes'];
    $glucosaDespues = $_POST['glucosaDespues'];
    $raciones = $_POST['racionesComida'];
    $insulina = $_POST['insulina'];
    $fecha = date("Y-m-d");
    $condicion = $_POST['condicion']; // Condición seleccionada (hipoglucemia/hiperglucemia)

    // Validar si ya se ha registrado la comida en el día actual
    $validarComida = "SELECT id_usu FROM comida WHERE tipo_comida = '$tipoComida' AND fecha = '$fecha' AND id_usu = $idUsuario";
    $resultadoValidacion = $conn->query($validarComida);

    if ($resultadoValidacion->num_rows > 0) {
        // Si la comida ya fue registrada
        $mensajeError = '<div class="alert alert-warning text-center mt-3" role="alert">
        Ya insertaste esta comida de hoy.
        </div>';
    } else {
        // Insertar datos de comida
        $insertarComida = "INSERT INTO comida (tipo_comida, gl_1h, gl_2h, raciones, insulina, fecha, id_usu) 
                           VALUES ('$tipoComida', '$glucosaAntes', '$glucosaDespues', '$raciones', '$insulina', '$fecha', $idUsuario)";
        
        if ($conn->query($insertarComida) === TRUE) {
            // Si la comida se inserta correctamente, verificar la condición

            // Si es Hiperglucemia
            if ($condicion == 'hiperglucemia') {
                $correccion = $_POST['correccion'];
                $glucosaHiper = $_POST['glucosahiper'];
                $horaHiper = $_POST['horahiper'];
                $insertarHiper = "INSERT INTO hiperglucemia (glucosahiper, hora, id_usu, fecha, correccion) 
                                  VALUES ('$glucosaHiper', '$horaHiper', $idUsuario, '$fecha', '$correccion')";
                $conn->query($insertarHiper);
            }

            // Si es Hipoglucemia
            elseif ($condicion == 'hipoglucemia') {
                $glucosaHipo = $_POST['glucosahipo'];
                $horaHipo = $_POST['horahipo'];
                $insertarHipo = "INSERT INTO hipoglucemia (glucosahipo, horahipo, id_usu, fecha) 
                                 VALUES ('$glucosaHipo', '$horaHipo', $idUsuario, '$fecha')";
                $conn->query($insertarHipo);
            }

            // Mensaje de éxito
            $insercionCompletada = '<div class="alert alert-warning text-center mt-3" role="alert">
            Datos registrados correctamente.
            </div>';
        } else {
            echo "Error al insertar los datos: " . $conn->error;
        }
    }
}
?>
