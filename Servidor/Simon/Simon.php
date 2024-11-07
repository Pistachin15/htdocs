<?php
session_start();
$colores = ['red', 'yellow', 'green', 'blue'];


$color1 = $colores[array_rand($colores)];
$color2 = $colores[array_rand($colores)];
$color3 = $colores[array_rand($colores)];
$color4 = $colores[array_rand($colores)];

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
    .circulo2 {
    display: inline-block;
      width: 100px;           
      height: 100px;         
      background-color: <?php echo $color2;?>;
      border-radius: 50%;    
    }
    .circulo3 {
    display: inline-block;
      width: 100px;           
      height: 100px;         
      background-color: <?php echo $color3;?>;
      border-radius: 50%;    
    }
    .circulo4 {
    display: inline-block;
      width: 100px;           
      height: 100px;         
      background-color: <?php echo $color4;?>;
      border-radius: 50%;    
    }
  </style>
</head>
<body>
  <div class="circulo1"></div>
  <div class="circulo2"></div>
  <div class="circulo3"></div>
  <div class="circulo4"></div>  
  <form action="#" method="post" class="mi-formulario">
            <input type="submit" value="Jugar" name=boton>
        </form>
</body>
</html>