<?php
/*
Escribe una función que reciba una cadena y comprueba si es un palíndromo
*/

function CadenaMenorLimite($cadena, $limite){
    for ($i = 0; $i < count($cadena); $i++){
        if($cadena[$i] >= $limite){
            unset($cadena[$i]);
        }
    }
    return $cadena;
   
}


$cadena = array(4,6,7,56,4,3,6,8,6,5,3,5,10,11);
    
$limite = 20;

$resultado = CadenaMenorLimite($cadena, $limite);
$id = 0;
foreach ($resultado as $numero){
    echo "Posicion $id : $numero<br>";
    $id++;
}
?>