<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego del número secreto</title>
</head>
<body>
<article>
        <form action="Ejercicio3.php" method="post" class="mi-formulario">
            <label for="numAdivinar">Adivina mi número:</label>
            <input type="text" id="numAdivinar" name="numAdivinar" required><br>
            <input type="submit" value="Enviar" name=boton>
        </form>
    </article>

    
</body>
</html>

<?php
session_start();


if (!isset($_SESSION['numRandom'])) {
    $numRandom = rand(1,3);
    $_SESSION['numRandom'] = $numRandom;
}

if (!isset($_SESSION['contador'])) {
    $_SESSION['contador'] = 0 ;
}


if( isset($_POST['boton'])){

    $_SESSION['contador']++;


    if ($_POST["numAdivinar"] > $_SESSION['numRandom']){
        echo "Tu numero es: ".$_POST["numAdivinar"]."<br>";
        echo "Mi numero es MAYOR<br>";


    }

    else if ($_POST["numAdivinar"] < $_SESSION['numRandom']){
        echo "Tu numero es: ".$_POST["numAdivinar"]."<br>";
        echo "Mi numero es MENOR<br>";

    }

    else if ($_POST["numAdivinar"] == $_SESSION['numRandom']){
        $link = `Ejercicio3.php`;
        echo "Tu numero es: ".$_POST["numAdivinar"]."<br>";
        echo "ENHORABUENA, HAS ACERTADO<br>";
        echo "Has necesitado ".$_SESSION['contador']." intentos";
        $_SESSION['contador'] = 0;
        $_SESSION['numRandom'] = rand(1,3);

?>
        <br>
        <a href="<?php echo $link; ?>">Jugar de nuevo</a>
        <br>
<?php

    }
    
}
?>


