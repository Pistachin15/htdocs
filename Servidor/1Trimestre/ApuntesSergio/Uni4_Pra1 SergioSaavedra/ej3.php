<?php
/*
    Construir una calculadora, se ha de resolver con un script, en la primera ejecución se
    ha de mostrar el formulario únicamente y en las posteriores, el resultado y el
    formulario con los valores guardados. Al pulsar uno de los cuatro botones se
    mostrará la operación solicitada de los valores introducidos en las cajas de texto.
*/
if (isset($_POST['num1'])) {

    /* if(isset($_POST['sumar'])) {
        echo $_POST['num1'],"+",$_POST['num2'],"= ",($_POST['num1']+$_POST['num2']);
    } else if (isset($_POST['resta'])) {
        echo $_POST['num1'],"-",$_POST['num2'],"= ",($_POST['num1']-$_POST['num2']);
    } else if (isset($_POST['mult'])) {
        echo $_POST['num1'],"*",$_POST['num2'],"= ",($_POST['num1']*$_POST['num2']);
    } else if (isset($_POST['division'])) {
        echo $_POST['num1'],"/",$_POST['num2'],"= ",($_POST['num1']/$_POST['num2']);
    } */

    switch ($_POST['boton']) {
        case 'sumar':
            echo $_POST['num1'],"+",$_POST['num2'],"= ",($_POST['num1']+$_POST['num2']);
        break;
        case 'resta':
            echo $_POST['num1'],"-",$_POST['num2'],"= ",($_POST['num1']-$_POST['num2']);
        break;
        case 'mult':
            echo $_POST['num1'],"*",$_POST['num2'],"= ",($_POST['num1']*$_POST['num2']);
        break;
        case 'divi':
            echo $_POST['num1'],"/",$_POST['num2'],"= ",($_POST['num1']/$_POST['num2']);
        break;
    }

} else {
    echo<<<_END
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <form action="#" method="post">
                <label for="num1">A:</label>
                <input type="number" id="num1" name="num1" required>

                <label for="num2">B:</label>
                <input type="number" id="num2" name="num2" required>

                <input type="submit" value="sumar" name="boton">
                <input type="submit" value="resta" name="boton">
                <input type="submit" value="mult" name="boton">
                <input type="submit" value="divi" name="boton">
            </form>
        </body>
        </html>
    _END;
}
?>