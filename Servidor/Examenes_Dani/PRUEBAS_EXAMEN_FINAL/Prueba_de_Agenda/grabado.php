//&Como vimos en ageenda cuando en acción ponemos el nombre de otro archivo
//&En este caso es grabado 
//&Dentro de el esta el proceso de grabado
<?php 
//^Volvemos a hacer la sesión
    session_start();
    require_once 'conexion.php';
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
    <!-- Volvemos a rescatar el nombre del usuario de la sesión -->
    <h2>Hola <?php echo  $_SESSION['usu'];?></h2>
    <?php
    /* Volvemos a hacer un for con la sesion y guardamos los  */
   /*  Datos de cada formulario en una variable */
        for ($i=1;$i<=$_SESSION['contador']+1; $i++) {
            $nombre = $_POST['nombre'.$i];
            $email = $_POST['email'.$i];
            $telf = $_POST['telefono'.$i];
    /* Y ahora lo insertamos */
            $query = "INSERT INTO contactos (nombre,email,telefono,codusuario) VALUES ('$nombre', '$email', '$telf', $cod)";
   /*  Guardamos la inserción en una variable resultado */
    //& Si da error de id duplicada en 0 es porque no esta en auto increment usa ALTER TABLE contactos MODIFY codcontacto INT AUTO_INCREMENT;
            $result = $connection->query($query);
    /* Y si el resultado sale mal nos da error */
            if (!$result) die("Fatal Error");
        }
        $connection->close();
        
    ?>
    <!-- Ponemos el contador que habiamos inciado antes en otro archivo y le sumamos uno para saber el 
    El número total de usuarios -->
    <p>Se han grabado los <?php echo  $_SESSION['contador']+1;?> contactos de <?php echo  $_SESSION['usu'];?></p>
    <a href="index.php">Volver a loguearse</a><br>
    <a href="inicio.php">Introducir más contactos para <?php echo  $_SESSION['usu'];?></a><br>
    <a href="totales.php">Total de contactos guardados</a><br>
    
</body>
</html>