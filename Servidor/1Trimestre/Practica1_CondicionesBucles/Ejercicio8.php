<?php
/*
Calcular si un número entero generado de forma aleatoria entre 1 y 1000 es
perfecto. Un número perfecto es aquel que la suma de sus divisores es él mismo,
por ejemplo el 6, sus divisores son 1,2,3 la suma de los mismos es 6
*/
$numero = rand(1, 1000);
$sumaDivisores = 0;

for ($i = 1; $i < $numero; $i++) {
    if ($numero % $i == 0) {
        $sumaDivisores += $i;
    }
}

if ($sumaDivisores == $numero) {
    echo "$numero es un número perfecto.";
} else {
    echo "$numero no es un número perfecto.";
}

?>