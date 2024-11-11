<?php
session_start();
$colores = ['red', 'yellow', 'green', 'blue'];


$color1 = $colores[array_rand($colores)];
$_SESSION['color'] = $color1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .circulo1 {
    display: inline-block;
      width: 100px;           
      height: 100px;         
      background-color: <?php echo $color1;?>;
      border-radius: 50%;    
    }
  </style>
</head>
<body>
  <div class="circulo1"></div>
  <form action="ValidarColor.php" method="post" class="mi-formulario">
            <input type="submit" value="Jugar" name=boton>
        </form>
</body>
</html>