<?php
/*
. Determinar la cantidad de dinero que recibirá un trabajador por concepto de las
horas extras trabajadas en una empresa, sabiendo que cuando las horas de
trabajo exceden de 40, el resto se consideran horas extras y que estas se pagan al
doble de una hora normal cuando no exceden de 8; si las horas extras exceden de
8 se pagan las primeras 8 al doble de lo que se pagan las horas normales y el resto
al triple.
*/
$HorasTrabajadas = 50;
$DineroHora = 20;

$DineroTotal = 0;

if($HorasTrabajadas > 40){

   $HorasExtra = $HorasTrabajadas - 40;

   if($HorasExtra > 8 ){

    $HorasExtra2 = $HorasExtra - 8;

    $HorasExtra = 8;

   }
}

$HorasTrabajadas = $HorasTrabajadas - $HorasExtra - $HorasExtra2;

$DineroTotal = $HorasTrabajadas * $DineroHora + $HorasExtra * (2 * $DineroHora) + $HorasExtra2 * (3 * $DineroHora);

echo "La suma total de dinero a cobrar es de $DineroTotal" ;
?>