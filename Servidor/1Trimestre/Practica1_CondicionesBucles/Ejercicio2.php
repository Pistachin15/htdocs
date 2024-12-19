<?php
/*
Dados 3 números asignados dentro del código a mostrar el número mayor de los
tres
*/

$num1 = 2;
$num2 = 7;
$num3 = 78;

if ($num1 > $num2 && $num1 > $num3){

    echo "El número mayor es ", $num1;

} else if ($num2 > $num1 && $num2 > $num3){
    
    echo "El número mayor es ", $num2;

} else if ($num3 > $num1 && $num3 > $num2){
        
    echo "El número mayor es ", $num3;
}  
?>