<?php
include 'Ejercicio5.php'; 

$Moto = new Dos_ruedas("Rojo", 150); 
$Moto->aniadir_persona(70); 
echo "Peso total de la moto después de añadir una persona: " . $Moto->getPeso() . " kg" . Vehiculo::SALTO_DE_LINEA;

$Moto->setColor("Verde"); 
$Moto->setCilindrada(1000); 

echo "<br>Atributos de la moto:<br>";
Vehiculo::ver_atributo($Moto);

$Camion = new Camion("Blanco", 6000, 10); 
$Camion->aniadir_persona(84); 
$Camion->repintar("Azul"); 

echo "<br>Atributos del camión:<br>";
Vehiculo::ver_atributo($Camion);


$SegundoVehiculo = new Coche("Verde", 1400, 0, 4); 
$SegundoVehiculo->aniadir_persona(65); 
$SegundoVehiculo->aniadir_persona(65); 

echo "<br>Atributos del coche antes de repintar:<br>";
Vehiculo::ver_atributo($SegundoVehiculo);

$SegundoVehiculo->repintar("Rojo");

$SegundoVehiculo->setNumeroCadenas(2);

echo "<br>Atributos del coche después de los cambios:<br>";
Vehiculo::ver_atributo($SegundoVehiculo);

echo "<br>Atributos del camión después de las modificaciones:<br>";
Vehiculo::ver_atributo($Camion);
?>
