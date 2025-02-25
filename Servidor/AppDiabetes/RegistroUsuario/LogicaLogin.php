<?php
session_start();
require_once '../login.php';

// Conexión a la base de datos
$conn = new mysqli($hn, $un, $pw, $db, $conn);
if ($conn->connect_error) die("Error en la conexión.");

// Recoger los datos del formulario
$nombre = $_POST['username'];
$contra = $_POST['password'];
$query = "SELECT contra FROM usuario WHERE usuario = '$nombre'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $contraHash = $row['contra'];
    // Comparar la contraseña ingresada con el hash
    if (password_verify($contra, $contraHash)) {
        $_SESSION['nombreUsu'] = $nombre;
        
        $nombreUsu = $_SESSION['nombreUsu'];
        $consultaId = "SELECT id_usu FROM usuario WHERE usuario = '$nombreUsu'"; //Consulta para recoger el id del usuario
        $resultado = $conn->query($consultaId); //Ejecutamos la consulta y lo almacenamos en una variable
        $fila = $resultado->fetch_assoc(); //Adelanto 1 posicion del array (-1 a 0) y almaceno lam fila en la variable
        $idUsuario = $fila['id_usu']; //Almacenamos el id de la columan id_usu en una variable 

        $_SESSION['id_usu'] = $idUsuario;

        header('Location:../Inicio/menuControl.php');
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
<form action="Formulario.html" method="post">
    <button type="submit">Volver a iniciar sesión</button>
</form>
