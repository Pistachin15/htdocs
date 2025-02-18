<?php
session_start();
require_once '../login.php'; // Archivo con credenciales de conexión a la base de datos
$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) die("Fatal Error");

if (isset($_POST['nombre']) && isset($_POST['apellidos']) &&  isset($_POST['fecha_nacimiento']) &&  isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password'])){
   
    $nombre = $_POST['nombre']; 
    $apellidos = $_POST['apellidos']; 
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $nombreUsuario = $_POST['username'];
    $contra = $_POST['password'];
    $contraConfirm = $_POST['confirm_password'];
    $hashContra = password_hash($contra, PASSWORD_DEFAULT);

    if (!empty($nombre) && !empty($apellidos) && !empty($fecha_nacimiento) && !empty($nombreUsuario) && !empty($contra) && !empty($contraConfirm)) {

        // Verificar que las contraseñas coincidan
        if ($contra === $contraConfirm) {
    
            // Comprobar si el usuario ya existe
            $consulta = "SELECT usuario FROM usuario WHERE usuario = '$nombreUsuario'";
    
            $result = $conn->query($consulta);
    
            if ($result && $result->num_rows > 0) {
    
                // Si el usuario ya existe
                $mensajeError = '<div class="alert alert-warning text-center mt-3" role="alert">
                El usuario <strong>' . htmlspecialchars($nombreUsuario) . '</strong> ya está registrado.
             </div>';
            } else {
    
                // Registrar el nuevo usuario
    
                $insert = "INSERT INTO usuario (nombre, apellidos, fecha_nacimiento, usuario, contra) VALUES ('$nombre', '$apellidos', '$fecha_nacimiento', '$nombreUsuario', '$hashContra')";
                if ($conn->query($insert)) {
                    $_SESSION['nombreUsu'] = $nombreUsuario; //Esto lo usaremos para luego insertar y demás al usuario correcto
                    header ('Location: FormularioRegistro.php');
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

}
$conn->close();


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <!-- Enlace a Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="bg-white p-4 rounded shadow-sm w-100" style="max-width: 400px;">
        <?php if (!empty($mensajeError)) echo $mensajeError; ?>
        <h2 class="text-center mb-4">Formulario de Registro</h2>
        <!-- Formulario de Registro -->
        <form action="FormularioRegistro.php" method="post">
            <div class="mb-3">
                <!-- Pedimos nombre -->
                <label for="nombre" class="form-label">Nombre:</label>  
                <input type="text" class="form-control" name="nombre" id="nombre" required>
            </div>

            <div class="mb-3">
                <!-- Pedimos apellidos -->
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" class="form-control" name="apellidos" id="apellidos" required>
            </div>

            <div class="mb-3">
                <!-- Pedimos fecha de nacimiento -->
                <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>

            <div class="mb-3">
                <!-- Pedimos nombre de usuario -->
                <label for="username" class="form-label">Usuario:</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>

            <div class="mb-3">
                <!-- Pedimos contraseña -->
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>

            <div class="mb-3">
                <!-- Pedimos confirmacion de contraseña -->
                <label for="confirm_password" class="form-label">Confirmar Contraseña:</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        </form>

        <!-- Separador -->
        <hr class="my-3">

        <!-- Botón para volver al login -->
        <form action="Formulario.html" method="post">
            <button type="submit" class="btn btn-secondary w-100">Volver a Iniciar Sesión</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>