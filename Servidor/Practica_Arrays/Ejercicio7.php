<?php
/*
Generar una matriz de 3x4 y generar un vector que contenga los valores máximos
de cada fila y otro que contenga los promedios de los mismos. Imprimir ambos
vectores a razón de uno por renglón
*/
$matriz = [];
for ($i = 0; $i < 3; $i++) {
    for ($j = 0; $j < 4; $j++) {
        $matriz[$i][$j] = rand(1, 100); 
    }
}

$maximos = [];
$promedios = [];

for ($i = 0; $i < 3; $i++) {
    $maximos[$i] = $matriz[$i][0]; 
    $suma = 0; 
    for ($j = 0; $j < 4; $j++) {
        if ($matriz[$i][$j] > $maximos[$i]) {
            $maximos[$i] = $matriz[$i][$j];
        }
        $suma += $matriz[$i][$j];
    }
    $promedios[$i] = $suma / 4;
}

echo "\nValores máximos de cada fila:\n";
for ($i = 0; $i < count($maximos); $i++) {
    echo $maximos[$i] . "\n";
}

echo "\nPromedios de cada fila:\n";
for ($i = 0; $i < count($promedios); $i++) {
    echo $promedios[$i] . "\n";
}

?>