<?php
//Sumar los numeros de la diagonal de una matriz 4x4
$matriz = array(array(15,10,25,8),
                array(3,2,1,7),
                array(19,25,10,8),
                array(9,15,25,13));
$sumaPrincipal = 0;
$SumaSecundaria = 0;
$contador = 0;
for ($i = 0; $i < 4; $i++){
    $sumaPrincipal = $sumaPrincipal + $matriz[$i][$i];
}

for ($i = 0; $i < 4; $i++){
    $SumaSecundaria = $SumaSecundaria + $matriz[$i][3-$i];
}
echo $sumaPrincipal;
echo "</br>";
echo $SumaSecundaria;

echo "</br>";
var_dump($matriz);
?>