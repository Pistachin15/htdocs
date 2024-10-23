<?php
if(isset($_POST['boton'])){

    $num1 =  $_POST ['num1'];
    $num2 =  $_POST ['num2'];

    $boton = $_POST['boton'];

    switch($boton){
        case "Sumar":
            echo $num1 + $num2;
            break;
        case "Resta":
            echo $num1 - $num2;
            break;
        case "Mult":
            echo $num1 * $num2;
            break;
        case "Division":
            echo $num1 / $num2;
            break;
    }

} 

?>


<html lang="es">
<body>

 <header>

    </header>

    <article>
        <form action="#" method="post" class="mi-formulario">
            <label for="num1">Numero 1:</label>
            <input type="text" id="num1" name="num1" required><br>
            <label for="num2">Numero 2:</label>
            <input type="text" id="num2" name="num2" required><br>
            <input type="submit" value="Sumar" name=boton>
            <input type="submit" value="Resta" name=boton>
            <input type="submit" value="Mult" name=boton>
            <input type="submit" value="Division" name=boton>
        </form>
    </article>

</body>

</html>

<?php

?>