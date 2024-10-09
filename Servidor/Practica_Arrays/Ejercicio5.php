<?php
/*
Generar de forma aleatoria una matriz de 3x5 con valores numéricos.
a. Imprimir todos los elementos en forma sucesiva tomándolos por fila.
b. Igual al anterior pero por columna.
*/

$MatrizAleatoria = [];

for ($i = 0; $i < 3; $i++){
    for ($j = 0; $j < 5; $j++){
        $MatrizAleatoria[$i][$j] = rand(1, 100);
        echo $MatrizAleatoria[$i][$j]. " ";

    }
} 

echo "<br>";

for ($j = 0; $j < 5; $j++){
    for ($i = 0; $i < 3; $i++){
        echo $MatrizAleatoria[$i][$j]. " ";
    }
}
?>