<?php
/*
Almacena en un array los 10 primeros números pares. Imprímelos cada uno en
una línea.
*/
$NumerosPares = [];
$numero = 0;

while (count($NumerosPares) <= 9){

    $NumerosPares[] = $numero;

    $numero += 2;
    }

var_dump ($NumerosPares);
?>
