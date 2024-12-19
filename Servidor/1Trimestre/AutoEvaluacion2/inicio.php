<?php
session_start();
$nombre = $_SESSION['nombreUsu'];
include "pintar-circulos.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simon</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>SIMÓN</h1>
    <br>
    <h1>Hola <?php echo $nombre; ?>, memoriza la combinación</h1>
    <form action="jugar.php" method="post">
        <?php
            $colors=["red","green","blue","yellow"];
            pintar_circulos($colors[array_rand($colors)],$colors[array_rand($colors)],$colors[array_rand($colors)],$colors[array_rand($colors)]);
        ?>
        <br><br>
        <input type="submit" value="Vamos a Jugar" name='jugar'>
    </form>
</body>
</html>

