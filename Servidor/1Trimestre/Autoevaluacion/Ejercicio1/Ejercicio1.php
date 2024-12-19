<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversión a Binario</title>
</head>
<body>
    <article>
        <form action="#" method="post" class="mi-formulario">

<?php
    $contador = 1;
    for ($i = 0; $i <= 2; $i++) {
        echo "<br>";
        for ($j = 0; $j <= 1; $j++) {
            echo "<label for='num$i$j'>E.$i.$j</label>";
            echo "<input type='text' id='num$i$j' name='num$i$j' required>";
            $contador++;
        }
    }
?>
        <br> 
        <input type="submit" value="Enviar" name="boton">
        <br>

<?php
if (isset($_POST['boton'])) {
    for ($i = 0; $i <= 2; $i++) {
        for ($j = 0; $j <= 1; $j++) {
            $campo = "num$i$j";
            if (isset($_POST[$campo])) {
                $valor = $_POST[$campo];
                    $binario = decbin($valor);
                    echo "<p> $valor  =  $binario</p>";
                }
            }
        }
    }

?>  

    </form>
</article>
</body>
</html>
