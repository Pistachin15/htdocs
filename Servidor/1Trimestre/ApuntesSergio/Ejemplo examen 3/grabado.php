<?php 
    session_start();
    require_once 'login.php';
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die("Fatal Error");
    $cod = $_SESSION['cod'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <h1>AGENDA</h1>
    <h2>Hola <?php echo  $_SESSION['usu'];?></h2>
    <?php
        for ($i=1;$i<=$_SESSION['contador']+1; $i++) {
            $nombre = $_POST['nombre'.$i];
            $email = $_POST['email'.$i];
            $telf = $_POST['telefono'.$i];
            $query = "INSERT INTO contactos (nombre,email,telefono,codusuario) VALUES ('$nombre', '$email', '$telf', $cod)";
            $result = $connection->query($query);
            if (!$result) die("Fatal Error");
        }
        $connection->close();
        
    ?>
    <p>Se han grabado los <?php echo  $_SESSION['contador']+1;?> contactos de <?php echo  $_SESSION['usu'];?></p>
    <a href="index.php">Volver a loguearse</a><br>
    <a href="inicio.php">Introducir más contactos para <?php echo  $_SESSION['usu'];?></a><br>
    <a href="totales.php">Total de contactos guardados</a><br>
    
</body>
</html>