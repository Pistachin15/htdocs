<?php
    /*
        ¿Qué acción realizará la siguiente línea de código HTML?
            Sexo:
            <input type="radio" name="sexo"
            <?php if (isset($sexo) && $sexo=="mujer") echo "checked";?>
            value="mujer"> Mujer
            <input type="radio" name="sexo"
            <?php if (isset($sexo) && $sexo=="hombre") echo "checked";?>
            value="hombre"> Hombre
            <span class="error">* <?php echo $sexoErr;?></span><br><br>
    */

    // Crea un formulario casillas de opcion unica 
    // Si la variable $sexo esta definida y es hombre o mujer marca de forma predeterminada la casilla que le corresponda
    // En el span se mostrara lo que contega la variable $sexoErr junto con el *

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="#">
    <input type="radio" name="sexo"
            <?php if (isset($sexo) && $sexo=="mujer") echo "checked";?>
            value="mujer"> Mujer
            <input type="radio" name="sexo"
            <?php if (isset($sexo) && $sexo=="hombre") echo "checked";?>
            value="hombre"> Hombre
            <span class="error">* <?php echo $sexoErr;?></span><br><br>
    </form>
    
</body>
</html>