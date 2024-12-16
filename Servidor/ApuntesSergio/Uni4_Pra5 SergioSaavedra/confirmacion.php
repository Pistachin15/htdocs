<?php
    session_start();
    if(isset($_POST["usu"])) {
        $_SESSION["usu"] = $_POST["usu"];
        $_SESSION["psw"] = $_POST["psw"];
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
    <p>Los datos introduciodos son los siguientes:</p><br>
    <br>
    <p>Usuario: <?php echo $_SESSION["usu"];?></p><br>
    <p>Contraseña: <?php echo $_SESSION["psw"];?></p><br>
    <br>
    <p>¿Son correctos?</p>
    <br>
    <a href="login.php">Si</a><br>
    <a href="index.php">No</a>

</body>
</html>