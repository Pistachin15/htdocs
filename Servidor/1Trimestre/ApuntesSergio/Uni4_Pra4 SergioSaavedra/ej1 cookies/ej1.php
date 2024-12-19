<?php
    if (!isset($_COOKIE["color"])) {
        $color = "white";
    } else {
        $color = $_COOKIE['color'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>

        </head>
        <body style='background-color: <?php echo $color;?>;'>
            <form action="ej1 cookies.php" method="post">
                <p>Seleccione el color de fondo: </p>
                <input type="radio" id="red" name="color" value="red">
                <label for="red">Rojo</label><br>
                <input type="radio" id="green" name="color" value="green">
                <label for="green">Verde</label><br>
                <input type="radio" id="blue" name="color" value="blue">
                <label for="blue">Azul</label><br>
                <input type="submit" value="Crear cookie" name="submit">
            </form>
        </body>
        </html>
</body>
</html>