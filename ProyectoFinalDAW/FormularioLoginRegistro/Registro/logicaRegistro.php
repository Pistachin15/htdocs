<?php
session_start();
require_once '../../login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Error en la conexión.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim(htmlspecialchars($_POST['nombre']));
    $apellidos = trim(htmlspecialchars($_POST['apellidos']));
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $usuario = trim(htmlspecialchars($_POST['usuario']));
    $contra = $_POST['password'];
    $contraConfirm = $_POST['confirm_password'];

    if (empty($nombre) || empty($apellidos) || empty($fecha_nacimiento) || empty($usuario) || empty($contra) || empty($contraConfirm)) {
        header("Location: registro.php?error=" . urlencode("Todos los campos son obligatorios"));
        exit();
    }

    if ($contra !== $contraConfirm) {
        header("Location: registro.php?error=" . urlencode("Las contraseñas no coinciden"));
        exit();
    }

    if ($fecha_nacimiento > date("Y-m-d")) {
        header("Location: registro.php?error=" . urlencode("La fecha de nacimiento no puede ser futura"));
        exit();
    }

    if ($fecha_nacimiento > date("Y-m-d")) {
        header("Location: registro.php?error=" . urlencode("La fecha de nacimiento no puede ser futura"));
        exit();
    }
    if ($fecha_nacimiento < "1900-01-01") {
    header("Location: registro.php?error=" . urlencode("La fecha de nacimiento no puede ser anterior a 1907"));
    exit();
    }

    // Comprobar si el usuario ya existe
    $consulta = $conn->prepare("SELECT username FROM usuarios WHERE username = ?");
    $consulta->bind_param("s", $usuario);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
        header("Location: registro.php?error=" . urlencode("Nombre de usuario ya existente"));
        exit();
    }

    $hashContra = password_hash($contra, PASSWORD_DEFAULT);
    $rol = 'cliente';

    $insert = $conn->prepare("INSERT INTO usuarios (nombre, apellidos, fecha_nacimiento, username, contra, rol) VALUES (?, ?, ?, ?, ?, ?)");
    $insert->bind_param("ssssss", $nombre, $apellidos, $fecha_nacimiento, $usuario, $hashContra, $rol);

    if ($insert->execute()) {
        header("Location: ../Logeo/login.php");
        exit();
    } else {
        header("Location: registro.php?error=" . urlencode("Error al registrar el usuario"));
        exit();
    }

    $consulta->close();
    $insert->close();
}

$conn->close();
?>
