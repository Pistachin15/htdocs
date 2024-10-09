<?php
/*
Almacena la función anterior en el fichero matemáticas.php. Crea un fichero que
la incluya y la utilice.
*/

include 'matematicas.php';

// Ejemplo de uso:
$coeficientes = [1, -3, 2]; // a = 1, b = -3, c = 2
$soluciones = resolverEcuacionCuadratica($coeficientes[0], $coeficientes[1], $coeficientes[2]);

if ($soluciones === FALSE) {
    echo "No hay soluciones reales.";
} else {
    echo "Las soluciones son: " . implode(", ", $soluciones);
}
?>
