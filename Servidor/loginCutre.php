<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdsimon0.00+010
0";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, 3007);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];
    
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "Acceso concedido. Bienvenido a la agenda.";
    } else {
        echo "Usuario o clave incorrectos. Inténtelo de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="POST">
        Usuario: <input type="text" name="usuario" required><br>
        Clave: <input type="password" name="clave" required><br>
        <input type="submit" value="Ingresar">
    </form>
</body>
</html>
