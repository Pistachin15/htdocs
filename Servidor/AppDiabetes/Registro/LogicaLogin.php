<?php
require_once '../login.php';

// Conexión a la base de datos
$conn = new mysqli($hn, $un, $pw, $db, 3307); // RECUERDA CAMBIAR ESTO (SOLAMENTE EN CLASE AÑADES EL PUERTO 3307)
if ($conn->connect_error) die("Fatal Error");

// Recoger los datos del formulario
$nombre = $_POST['username'];
$contra = $_POST['password'];

// Validar que los campos no estén vacíos
if (!empty($nombre) && !empty($contra)) {

    // Consulta para obtener el hash de la contraseña desde la base de datos
    $query = "SELECT contra FROM usuario WHERE usuario='$nombre'"; // Suponiendo que hay una tabla 'users' con la columna 'password'
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Obtener el hash de la contraseña de la base de datos
        $row = $result->fetch_assoc();
        $contraHash = $row['contra'];

        // Verificar si la contraseña ingresada coincide con el hash almacenado
        if (password_verify($contra, $contraHash)) {
            echo "Bienvenido, $nombre";
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

} else {
    echo "Por favor, completa todos los campos.";
}

// Cerrar la conexión
$conn->close();
?>

<!-- Formulario para volver a intentar -->
<form action="Formulario.html" method="post" class="mi-formulario">
    <button type="submit" name="register">Volver a iniciar sesión</button>
</form>
