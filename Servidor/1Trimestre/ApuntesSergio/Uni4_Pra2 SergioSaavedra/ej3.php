<?php
/*
        ¿Qué acción realizará la siguiente línea de código html?
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
    */

    //Apunta a la ruta relativa del archivo que lo esta ejecutando
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    </form>
</body>

</html>