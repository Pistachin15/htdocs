<?php
session_start();
require_once '../../login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Error en la conexión.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $usuario = $_POST['usuario'];
    $contra = $_POST['password'];
    $contraConfirm = $_POST['confirm_password'];
    $hashContra = password_hash($contra, PASSWORD_DEFAULT);

    // Verificar que las contraseñas coincidan
    if ($contra !== $contraConfirm) {
        die("Las contraseñas no coinciden.");
    }

    // Verificar que la fecha de nacimiento no sea futura
    if ($fecha_nacimiento > date("Y-m-d")) {
        die("La fecha de nacimiento no puede ser futura.");
    }

    // Verificar si el usuario ya está registrado
    $consulta = $conn->prepare("SELECT usuario FROM usuarios WHERE usuario = ?");
    $consulta->bind_param("s", $usuario);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
        die("El usuario ya está registrado.");
    } else {
        // Insertar el nuevo usuario en la base de datos
        $insert = $conn->prepare("INSERT INTO usuarios (nombre, apellidos, fecha_nacimiento, usuario, contraseña) VALUES (?, ?, ?, ?, ?)");
        $insert->bind_param("sssss", $nombre, $apellidos, $fecha_nacimiento, $usuario, $hashContra);

        if ($insert->execute()) {
            $_SESSION['nombreUsu'] = $usuario;
            header("Location: registro.html");
        } else {
            die("Error al registrar el usuario: " . $conn->error);
        }
    }
}

// Cerrar la conexión
$conn->close();
?>
