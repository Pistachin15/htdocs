<?php
/*
Escribe una función que reciba una cadena y comprueba si es un palíndromo.
*/

function cadenaPalindroma ($Cadena){
    $CadenaInvertida = strrev($Cadena);

    if($Cadena == $CadenaInvertida){
        echo "La cadena introducida $Cadena es palindroma";
    }
}

$Cadena = "oso";
cadenaPalindroma($Cadena);

?>