<?php
/*Dados 2 números asignados dentro del código a variables realizar el siguiente
cálculo: si son iguales que los multiplique, si el primero es mayor que el segundo
que los reste y si no que los sume. Mostrar el resultado en pantalla.
*/

$num1 = 9;
$num2 = 10;
$resultado = 0;

if ($num1 == $num2 ){

    $resultado = $num1 * $num2;

} else if ($num1 > $num2 ){

    $resultado = $num1 - $num2;

} else $resultado = $num2 + $num1;

echo $resultado;




?>