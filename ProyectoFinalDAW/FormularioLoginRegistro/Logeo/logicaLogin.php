<?php
session_start();
require_once '../../login.php';

// Conexión a la base de datos
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Error en la conexión.");
}

// Recoger los datos del formulario
$usuario = $_POST['usuario'];
$contra = $_POST['password'];

// Preparar la consulta para evitar inyección SQL
$consulta = $conn->prepare("SELECT id_usuario, contraseña FROM usuarios WHERE usuario = ?");
$consulta->bind_param("s", $usuario);
$consulta->execute();
$resultado = $consulta->get_result();

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $contraHash = $fila['contraseña'];

    // Comparar la contraseña ingresada con el hash
    if (password_verify($contra, $contraHash)) {
        $_SESSION['nombreUsu'] = $usuario;
        $_SESSION['id_usuario'] = $fila['id_usuario'];

        header('Location: ../../Inde.php');
        exit();
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
<form action="login.php" method="post">
    <button type="submit">Volver a iniciar sesión</button>
</form>
