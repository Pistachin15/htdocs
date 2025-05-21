<?php
session_start();
require_once '../../login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Error en la conexión.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellidos = htmlspecialchars($_POST['apellidos']);
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $usuario = htmlspecialchars($_POST['usuario']);
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
    $consulta = $conn->prepare("SELECT username FROM usuarios WHERE username = ?");
    $consulta->bind_param("s", $usuario);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
        die("El nombre de usuario ya está registrado.");
    } else {
        // Insertar el nuevo usuario con rol 'cliente'
        $rol = 'cliente';
        $insert = $conn->prepare("INSERT INTO usuarios (nombre, apellidos, fecha_nacimiento, username, contra, rol) VALUES (?, ?, ?, ?, ?, ?)");
        $insert->bind_param("ssssss", $nombre, $apellidos, $fecha_nacimiento, $usuario, $hashContra, $rol);

        if ($insert->execute()) {
            $_SESSION['nombreUsu'] = $usuario;
            header("Location: registro_exitoso.html"); // o la página que prefieras
            exit();
        } else {
            die("Error al registrar el usuario: " . $conn->error);
        }
    }

    $consulta->close();
    $insert->close();
}

$conn->close();
?>
