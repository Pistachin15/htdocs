<?php
session_start();

if (isset($_POST['login'])) {
$conn = new mysqli('localhost', 'root', '', 'cartas');
if ($conn->connect_error) die("Fatal Error"); 

$nombre = $_POST['username'];
$contra = $_POST['password'];



if (!empty($nombre) && !empty($contra)) {
    $consulta = "SELECT login, clave FROM jugador WHERE login = '$nombre' AND clave = '$contra'"; //Aqui cambias los nombre de usuario y contraseña segun tu base de datos

    $result = $conn->query($consulta);

    if ($result) {
        if ($result->num_rows > 0) {
            $_SESSION['nombreUsu'] = $nombre;
            header("Location: mostrarCartas.php");
        } else {
            echo "Usuario o contraseña incorrectos.";
            ?>
            <form action="index.php" method="post" class="mi-formulario">
            <button type="submit" name="register">Volver a iniciar sesión</button>
            </form>
            <?php
        }
    } else {
        echo "Error en la consulta: " . $conn->error;

    }
} else {
    echo "Por favor, completa todos los campos.";
}

$conn->close();
}
?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Login</title>
    <style>
    </style>
</head>
<body>
<!-- Esto no lo toques que funciona -->
    <form action="#" method="post" class="mi-formulario"> 
        <h2>Formulario de Login</h2>
        <br>

        <!-- Campo para el nombre de usuario -->
        <label for="username">Usuario:</label>
        <input type="text" name="username" id="username" required>
        <br>

        <!-- Campo para la contraseña -->
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>

        <br>
        <!-- Botón para Login -->
        <button type="submit" name="login">Iniciar Sesión</button>
    </form>
    <br>
</body>
</html>

