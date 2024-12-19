<?php


if(isset($_COOKIE['colorFondo'])){
    $colorFondo = $_COOKIE['colorFondo'];


   
} 
else{
    setcookie('colorFondo', $_POST['fondo'], time() + 60 * 60 *24 * 7,'/');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-color: <?php echo $colorFondo ?>;
        }
    </style>
</head>
<body>
<article>
    <h1>Seleccione de que color desea que sea la web de ahora en adelante</h1>
        <form action="Ejercicio1.php" method="post" class="mi-formulario">
            <input type="radio" value="red" name="fondo">
            <label>Rojo</label><br>
            <input type="radio" value="green" name="fondo">
            <label>Verde</label><br>
            <input type="radio" value="blue" name="fondo">
            <label>Azul</label><br>

            <input type="submit" value="Crear cookie" name="boton">
        </form>
    </article>

    
</body>
</html>