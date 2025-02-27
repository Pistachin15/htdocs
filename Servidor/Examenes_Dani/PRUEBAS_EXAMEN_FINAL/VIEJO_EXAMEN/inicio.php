<?php
    require_once('conexion.php');
    session_start();
    $tiempo = time();
    $hora = date('G').":".date('i').":".date('s');
    $fecha = "2024-12-12";
    $_SESSION['fecha'] = $fecha;
    
    $login = $_SESSION["login"];
    /* var_dump($fecha); */

    if (isset($_POST['resp'])) {
        $resp = $_POST['resp'];
        $query = "INSERT INTO respuestas (fecha,login,hora,respuesta) VALUES ('$fecha', '$login', '$hora', '$resp')";
        $result = $conn->query($query);
        if (!$result) die("Fatal Error");
    }
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienevenido, <?php echo $_SESSION['nom']?>!</h1>
    <img src="imagen/20241212.jpg">
    <form action="#" method="post">
        <label for="resp">Solución al jerogrifico:</label>
        <input type="text" id="resp" name="resp" required>
        <br>
        <input type="submit" value="Enviar">

    </form>
    <a href="puntos.php">Ver puntos por jugador</a><br>
    <a href="resultado.php">Resultados del día</a>
</body>
</html>