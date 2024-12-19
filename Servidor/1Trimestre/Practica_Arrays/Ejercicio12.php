<?php
/*
Crea un array asociativo para introducir los datos de una persona
 Nombre: Pedro Torres
 Dirección: C/Mayor, 37
 Teléfono: 123456789
Al acabar muestra los datos por pantalla
*/

$DatosPersona = array("Nombre" => "Pedro Torre",
                        "Direccion" => "C/Mayor, 37",
                        "Telefono" => 123456789);

foreach($DatosPersona as $clave => $valor){
    echo "$clave : $valor<br>";
}

?>