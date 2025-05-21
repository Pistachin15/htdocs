<?php
session_start();
require_once '../../login.php';

// Conexión a la base de datos
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Error en la conexión.");

// Verificar que los datos del formulario estén presentes
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['username'], $_POST['password'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Consulta segura
    $stmt = $conn->prepare("SELECT id_usuario, contra, rol FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si el usuario existe
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hash = $row['contra'];

        // Verificar la contraseña
        if (password_verify($password, $hash)) {
            // Guardar datos de sesión
            $_SESSION['id_usu'] = $row['id_usuario'];
            $_SESSION['nombreUsu'] = $username;
            $_SESSION['rol'] = $row['rol'];

            // Redirigir según el rol
            header('Location: ../../Inde.php');
            exit();
        } else {
            $mensaje = "Contraseña incorrecta.";
        }
    } else {
        $mensaje = "Usuario no encontrado.";
    }

    $stmt->close();
} else {
    $mensaje = "Datos del formulario no enviados correctamente.";
}

$conn->close();
?>
