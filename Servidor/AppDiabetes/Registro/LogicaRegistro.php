<?php
require_once '../login.php'; // Archivo con credenciales de conexión a la base de datos
$conn = new mysqli($hn, $un, $pw, $db, 3307 );

if ($conn->connect_error) die("Fatal Error");
// Obtener datos del formulario
$nombre = $_POST['nombre']; 
$apellidos = $_POST['apellidos']; 
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$nombreUsuario = $_POST['username'];
$contra = $_POST['password'];
$contraConfirm = $_POST['confirm_password'];
$hashContra = password_hash($contra, PASSWORD_DEFAULT);
// Verificar que los campos no estén vacíos
if (!empty($nombre) && !empty($apellidos) && !empty($fecha_nacimiento) && !empty($nombreUsuario) && !empty($contra) && !empty($contraConfirm)) {
    // Verificar que las contraseñas coincidan
    if ($contra === $contraConfirm) {
        // Comprobar si el usuario ya existe
        $consulta = "SELECT usuario FROM usuario WHERE usuario = '$nombreUsuario'";
        $result = $conn->query($consulta);

        if ($result && $result->num_rows > 0) {
            // Si el usuario ya existe
            echo "El usuario $nombreUsuario ya está registrado.";
        } else {
            // Registrar el nuevo usuario
            $insert = "INSERT INTO usuario (nombre, apellidos, fecha_nacimiento, usuario, contra) VALUES ('$nombre', '$apellidos', '$fecha_nacimiento', '$nombreUsuario', '$hashContra')";
            if ($conn->query($insert)) {
                echo "Registro exitoso. Bienvenido, $nombreUsuario.";
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
