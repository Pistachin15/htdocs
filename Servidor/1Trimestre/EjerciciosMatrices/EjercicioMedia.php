<?php
//Hacer una matriz de tres dimensiones utilizando bucles y luego mostrar un dato de la propia matriz
$num = 10;
$contador = 0;
$suma = 0;
for ($i = 0; $i <= 4; $i++){
        $M[$i] = $num;
        $suma = $suma + $num;
        $num = $num + 10;
        $contador++;

}
echo $suma/$contador;
echo "</br>";
var_dump($M);
?>