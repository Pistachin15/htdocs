<?php
/*
Hacer un algoritmo que llene una matriz de 10x10 con valores aleatorios y
determine la posición [fila, columna] del número mayor almacenado en la matriz. 
*/
$MatrizAleatoria = [];
for ($i = 0; $i < 10; $i++) {
    for ($j = 0; $j < 10; $j++) {
        $MatrizAleatoria[$i][$j] = rand(1, 100); 
    }
}

$ValorMayor = 0;
$Mayor_i = 0;
$Mayor_j = 0;

for ($i = 0; $i < 10; $i++){

    for ($j = 0; $j < 10; $j++){
        if($ValorMayor < $MatrizAleatoria[$i][$j]){

            $ValorMayor = $MatrizAleatoria[$i][$j];
            $Mayor_i = $i;
            $Mayor_j = $j;
        }
    }
}

echo "El mayor valor de la matriz es $ValorMayor, y su fila y su linea son $Mayor_i i y $Mayor_j j";


?>