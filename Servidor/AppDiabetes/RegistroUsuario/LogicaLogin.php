<?php
session_start();
require_once '../login.php';

// Conexión a la base de datos
$conn = new mysqli($hn, $un, $pw, $db, 3307);
if ($conn->connect_error) die("Error en la conexión.");

// Recoger los datos del formulario
$nombre = $_POST['username'];
$contra = $_POST['password'];
$query = "SELECT contra FROM usuario WHERE usuario = '$nombre'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $contraHash = $row['contra'];
    // Comparar la contraseña ingresada con el hash
    if (password_verify($contra, $contraHash)) {
        $_SESSION['nombreUsu'] = $nombre;
        header('Location:../Inicio/menuControl.php');
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
} else {
    echo "Usuario no encontrado.";
}

// Cerrar la conexión
$conn->close();
?>

<!-- Formulario para volver a intentar -->
<form action="Formulario.html" method="post">
    <button type="submit">Volver a iniciar sesión</button>
</form>
