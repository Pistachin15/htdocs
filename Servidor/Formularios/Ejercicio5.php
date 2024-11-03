<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <article>
        <form action="#" method="post" class="mi-formulario">

<?php
if(isset($_POST['boton'])){

    $sumaTotal = 0;

    for($i = 1; $i < 10; $i++){
        $num =  $_POST ["num{$i}"] ?? 0;
        $sumaTotal += $num;

        echo "$i = $num<br>";
        

    }

    echo "La suma es $sumaTotal<br>";
} 

?>

<?php
    for ($j = 1; $j < 10; $j++){
        echo "<label for='$j'>Numero $j:</label>";
        echo "<input type='text' id='$j' name='num$j' required><br>";

}

?>
        <input type="submit" value="Enviar" name=boton>
