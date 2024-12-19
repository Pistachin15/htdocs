<?php
/*
Escriba un programa a partir de un número entero generado de forma aleatoria
indique si es primo. Un número primo es aquel que es divisible por el mismo y la
unidad.
*/
$numero = rand(1, 100);
$esPrimo = true;

if ($numero <= 1) {
    $esPrimo = false;
} else {
    for ($i = 2; $i < $numero; $i++) {
        if ($numero % $i == 0) {
            $esPrimo = false; 
            break; 
        }
    }
}

if ($esPrimo) {
    echo "$numero es un número primo.";
} else {
    echo "$numero no es un número primo.";
}




?>