<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db, 3307);
if ($conn->connect_error) die("Fatal Error"); 

$nombre = $_POST['username'];
$contra = $_POST['password'];



if (!empty($nombre) && !empty($contra)) {
    $consulta = "SELECT usu, contra FROM usuarios WHERE usu = '$nombre' AND contra = '$contra'";

    $result = $conn->query($consulta);

    if ($result) {
        if ($result->num_rows > 0) {
            echo "Bienvenido, $nombre";
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    } else {
        echo "Error en la consulta: " . $conn->error;
    }
} else {
    echo "Por favor, completa todos los campos.";
}

$conn->close();
?>

<form action="Formulario.php" method="post" class="mi-formulario">
    <button type="submit" name="register">Volver a iniciar sesión</button>
</form>
