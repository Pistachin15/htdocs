<?php
    session_start();
    
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="confirmacion.php" method="post">
        <p>Bienvenido, introduce tu nombre de usuario y contraseña:</p><br>
        <input type="text" id="usu" name="usu" required><br>
        <input type="password" id="psw" name="psw" required><br>
        <input type="submit" value="Enviar" name="submit">
    </form>
</body>
</html>

