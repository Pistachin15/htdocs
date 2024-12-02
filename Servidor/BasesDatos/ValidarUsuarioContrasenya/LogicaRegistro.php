<?php
require_once 'login.php'; // Archivo con credenciales de conexión a la base de datos
$conn = new mysqli($hn, $un, $pw, $db, 3307);

if ($conn->connect_error) die("Fatal Error");

// Obtener datos del formulario
$nombre = $_POST['username'];
$contra = $_POST['password'];
$contraConfirm = $_POST['confirm_password'];
$rol = $_POST['rol'];

// Verificar que los campos no estén vacíos
if (!empty($nombre) && !empty($contra) && !empty($contraConfirm)) {
    // Verificar que las contraseñas coincidan
    if ($contra === $contraConfirm) {
        // Comprobar si el usuario ya existe
        $consulta = "SELECT usu FROM usuarios WHERE usu = '$nombre'";
        $result = $conn->query($consulta);

        if ($result && $result->num_rows > 0) {
            // Si el usuario ya existe
            echo "El usuario $nombre ya está registrado.";
        } else {
            // Registrar el nuevo usuario
            $insert = "INSERT INTO usuarios (usu, contra, rol) VALUES ('$nombre', '$contra', '$rol')";
            if ($conn->query($insert)) {
                echo "Registro exitoso. Bienvenido, $nombre.";
            } else {
                echo "Error al registrar el usuario: " . $conn->error;
            }
        }
    } else {
        echo "Las contraseñas no coinciden.";
    }
} else {
    echo "Por favor, completa todos los campos.";
}

$conn->close();
?>

<!-- Formulario para regresar al inicio -->
<form action="Formulario.html" method="post" class="mi-formulario">
    <button type="submit" name="register">Volver a la página principal</button>
</form>
