<?php
/*
Hacer un programa que calcule todos los números primos entre 1 y 50 y los
muestre por pantalla. Un número primo es un número entero que sólo es
divisible por 1 y por sí mismo.
*/
echo "Los numero primos entre 1 y 50 son los siguientes:";
echo "</br>";
for ($numero = 2; $numero <= 50; $numero++) {
    $esPrimo = true; 

    for ($i = 2; $i < $numero; $i++) {
        if ($numero % $i == 0) {
            $esPrimo = false; 
            break; 
        }
    }

    if ($esPrimo) {
        echo "$numero es primo.<br>";
    }
}
?>