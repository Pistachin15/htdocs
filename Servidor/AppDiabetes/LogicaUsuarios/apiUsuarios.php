<?php
require_once '../login.php';
$conn = new mysqli($hn, $un, $pw, $db, 3307);
$nombre = $_POST['username'];
$apellidos = $_POST['apellidos'];
$password = $_POST['password'];
$contraHash = $_POST['confirmContraseña'];
function CrearUsuario($nombre, $apellidos, $fecha_nacimiento, $usuario, $password, $conn, $contraHash){

if ($conn->connect_error) die("Error en la conexión.");

$query = "SELECT contra FROM usuario WHERE usuario = '$nombre'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $contraHash = $row['contra'];
    // Comparar la contraseña ingresada con el hash
    if (password_verify($password, $contraHash)) {
        $_SESSION['nombreUsu'] = $nombre;
        header('Location:../Inicio/menuControl.php');
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
} else {
    echo "Usuario no encontrado.";
}
}
