<?php
/*
Llenar una matriz de 20x20 con valores aleatorios. Sumar las columnas e
imprimir la columna que tuvo la máxima suma y la suma de esa columna.
*/
$MatrizAleatoria = [];
for ($i = 0; $i < 20; $i++) {
    for ($j = 0; $j < 20; $j++) {
        $MatrizAleatoria[$i][$j] = rand(1, 100); 
    }
}

for ($i = 0; $i < 20; $i++ ){
    $SumaColumnas [$i] = 0;
}


$MayorSuma = 0;
$numColumna = 0;
for ($i = 0; $i < 20; $i++) {
    for ($j = 0; $j < 20; $j++) {
        $SumaColumnas[$i] += $MatrizAleatoria[$i][$j];
        
    }
}

for ($i = 0; $i < 20; $i++) {
    if ($MayorSuma < $SumaColumnas[$i]){
        $MayorSuma = $SumaColumnas[$i];

        $numColumna = $i;
    }
}

echo "La columna que tuvo la máxima suma es la numero $numColumna y la suma de esa columna es $MayorSuma";









?>