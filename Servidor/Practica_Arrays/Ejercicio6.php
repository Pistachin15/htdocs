<?php
/*
Generar de forma aleatoria una matriz de 4*5 con valores numéricos, determinar
fila y columna del elemento mayor.
*/

$matriz = [];

$numMayor = 0;
$columnaMayor = 0;
$filaMayor = 0;

for ($i = 0; $i < 3; $i++){
    for ($j = 0; $j < 4; $j++){
        $matriz[$i][$j] = rand(1,100);

    }
}

for ($i = 0; $i < 3; $i++){
    for ($j = 0; $j < 4; $j++){
        if($matriz[$i][$j] > $numMayor){
            $numMayor = $matriz[$i][$j];
            $filaMayor = $i;
            $columnaMayor = $j;

        }

    }
}

echo "El mayor elemento de la matriz es $numMayor, donde su columna es la $columnaMayor y su fila es $filaMayor";




?>