<?php
/*
Repite el ejercicio anterior pero ahora si se han de crear índices asociativos,
ejemplo:
*/
$Ciudades = ["Madrid" => "MD", "Barcelona" => "BC", "Londres" => "LD", "New York" => "NY", "Los Ángeles" => "LA", "Chicago" => "CH"];

foreach ($Ciudades as $ciudad => $abreviatura){
    echo "El índice del array que contiene como valor $ciudad es $abreviatura<br>";
}
?>