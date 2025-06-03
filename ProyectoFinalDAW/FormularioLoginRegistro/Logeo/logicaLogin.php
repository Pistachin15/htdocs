<?php
session_start();
require_once '../../login.php';

$error = ''; 

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['username'], $_POST['password'])) {
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die("Error en la conexión.");

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id_usuario, contra, rol FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['contra'])) {
            $_SESSION['id_usu'] = $row['id_usuario'];
            $_SESSION['nombreUsu'] = $username;
            $_SESSION['rol'] = $row['rol'];
            header('Location: ../../Index.php');
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }

    $stmt->close();
    $conn->close();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $error = "Por favor, rellena todos los campos.";
}
?>
