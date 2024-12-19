<?php
session_start();
$nombreUsu = $_SESSION['nombreUsu'];
echo "<h2>Bienvenido, $nombreUsu!</h2><br>";
echo "<img src=img/20241212.jpg>";
$conn = new mysqli('localhost', 'root', '', 'jeroglifico', 3307);
if ($conn->connect_error) die("Fatal Error"); 

$respuesta = $_POST['respuesta'];
$fecha = '2023-01-06';
$hora = '12:36:20';


if (!empty($respuesta)) {
    $insert = "INSERT INTO respuestas (fecha, login, hora, respuesta) VALUES ('$fecha', '$nombreUsu', '$hora', '$respuesta')";


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="inicio.php" method="post" class="mi-formulario">
            <label for="respuesta">Solucion al jeroglifico</label>
            <input type="text" name="respuesta" id="respuesta" required>
            <br>
            <button type="submit" name="enviar">Enviar</button>
        </form>
    <a href=puntos.php>Ver puntos por jugador</a>
    <br>
    <a href=resultado.php>Resultados del dia</a>
</body>
</html>
