<?php
/* Identificar entre dos números aleatorios cual es el mayor y si este es par o impar.
Buscar información previamente para generar números aleatorios y usarla para
resolver el ejercicio.
*/

$num1 = rand(1,100);
$num2 = rand(1,100);

if($num1 > $num2){
    echo "$num1 es mayor que $num2";
    
    if($num1 % 2 == 0){
        echo "</br>";
        echo "Además, $num1 es par";
    } else{
        echo "</br>";
        echo "Además, $num1 es par";

    }
}

if($num2 > $num1){
    echo "$num2 es mayor que $num1";
    
    if($num2 % 2 == 0){
        echo "</br>";
        echo "Además, $num2 es par";
    } else{
        echo "</br>";
        echo "Además, $num es par";

    }
}

?>