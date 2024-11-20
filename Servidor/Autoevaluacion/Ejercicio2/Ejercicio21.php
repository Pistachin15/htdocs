<?php session_start();?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>
<?php
        if($_POST['resp'] == $_SESSION['resul']) {
            $resul = $_SESSION['resul'];
?>
<h1>Respuesta acertada el número es, <?php echo $resul; ?></h1>
<a href='ejercicio2.php'>VOLVER A JUGAR</a>
<?php
            session_destroy();
        } else {
?>
<h1>Has fallado, vuelve a jugar</h1>
<a href='ejercicio2.php'>VOLVER A JUGAR</a>
<?php
            session_destroy();
        }
    ?>
</body>
</html>