<?php
if (isset($_POST['num1'])) {
    echo "La suma de ".$_POST['num1']."+".$_POST['num2']."= ".($_POST['num1']+$_POST['num2'])."<br>";
    var_dump($_POST);
} else {
    echo <<<_END
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <form action="#" method="post">
                <label for="num1">Numero 1:</label><br>
                <input type="number" id="num1" name="num1" required><br><br>

                <label for="num2">Numero 2:</label><br>
                <input type="number" id="num2" name="num2" required><br><br>

                <input type="submit" value="Enviar">
            </form>
        </body>
        </html>
    _END;
}

?>