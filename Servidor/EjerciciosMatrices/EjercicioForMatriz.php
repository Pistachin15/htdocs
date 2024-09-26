<?php
//Hacer una matriz de tres dimensiones utilizando bucles y luego mostrar un dato de la propia matriz
$contador = 1;
for ($i = 0; $i <= 1; $i++){
    
    for ($j = 0; $j <= 2; $j++){

        $M[$i][$j] = $contador;

        $contador++;

    }
}
echo $M[1][2];
echo "</br>";
var_dump($M);
?>