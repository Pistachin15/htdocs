<?php
/*
Crea una función para resolver la ecuación de segundo grado. Esta función recibe
los coeficientes de la ecuación y devuelve un array con las soluciones. Si no hay
soluciones reales, devuelve FALSE.
*/

function resolverEcuacionCuadratica($a, $b, $c) {
    if ($a == 0) {
        return FALSE; // No es una ecuación de segundo grado
    }

    $discriminante = $b ** 2 - 4 * $a * $c;

    if ($discriminante < 0) {
        return FALSE; 
    } else if ($discriminante == 0) {
        $x = -$b / (2 * $a);
        return [$x]; 
    } else {
        $x1 = (-$b + sqrt($discriminante)) / (2 * $a);
        $x2 = (-$b - sqrt($discriminante)) / (2 * $a);
        return [$x1, $x2];
    }
}

$coeficientes = [1, -3, 2]; 
$soluciones = resolverEcuacionCuadratica($coeficientes[0], $coeficientes[1], $coeficientes[2]);

if ($soluciones === FALSE) {
    echo "No hay soluciones reales.";
} else {
    echo "Las soluciones son: " . implode(", ", $soluciones);
}



?>
