<?php
/*
Generar de forma aleatoria una matriz de 4*5 con valores numéricos, determinar
fila y columna del elemento mayor.
*/

$MatrizAleatoria = [];

for ($i = 0; $i < 4; $i++){
    for ($j = 0; $j < 5; $j++){
        $MatrizAleatoria[$i][$j] = rand(1, 100);
    }
}

$ValorMayor = 0;
$Mayor_i = 0;
$Mayor_j = 0;

for ($i = 0; $i < 4; $i++){

    for ($j = 0; $j < 5; $j++){
        if($ValorMayor < $MatrizAleatoria[$i][$j]){

            $ValorMayor = $MatrizAleatoria[$i][$j];
            $Mayor_i = $i;
            $Mayor_j = $j;
        }
    }
}

echo "El mayor valor de la matriz es $ValorMayor, y su fila y su linea son $Mayor_i i y $Mayor_j j";
?>