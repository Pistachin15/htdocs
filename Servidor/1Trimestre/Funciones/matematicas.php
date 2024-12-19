<?php
function resolverEcuacionCuadratica($a, $b, $c) {
    if ($a == 0) {
        return FALSE; // No es una ecuación de segundo grado
    }

    $discriminante = $b ** 2 - 4 * $a * $c;

    if ($discriminante < 0) {
        return FALSE; // No hay soluciones reales
    } elseif ($discriminante == 0) {
        $x = -$b / (2 * $a);
        return [$x]; // Una solución real
    } else {
        $x1 = (-$b + sqrt($discriminante)) / (2 * $a);
        $x2 = (-$b - sqrt($discriminante)) / (2 * $a);
        return [$x1, $x2]; // Dos soluciones reales
    }
}
?>
