<?php
$usuario = $_POST['usu'];
$contra = $_POST['psw'];
$rol = $_POST['rol'];
require_once 'rootlogin.php';
$connection = new mysqli($hn, $un, $pw, $db);
if ($connection->connect_error) die("Fatal Error");
$query = "SELECT USU FROM usuarios WHERE USU= '$usuario'";
$result = $connection->query($query);
if (!$result) die("Fatal Error");
$rows = $result->num_rows;
if ($contra == $_POST['reppsw'] && $rows == 0) {
    $query = "INSERT INTO usuarios (USU,CONTRA,ROL) VALUES ('$usuario','$contra','$rol')";
    $result = $connection->query($query);
    if (!$result) die("Fatal Error");
    echo "<a href='acceso.php'>USUARIO CREADO</a>";
} else if ($rows > 0) {
    echo "<a href='acceso.php'>EL USUARIO YA EXISTE</a>";
} else {
    echo "<a href='registro.php'>LAS CONTRASEÑAS NO COINCIDEN</a>";
}
$connection->close();
?>