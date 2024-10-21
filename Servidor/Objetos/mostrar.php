<?php
include 'Ejercicio5.php';

// Crear un objeto Dos_ruedas
$Moto = new Dos_ruedas("Rojo", 150); // Cambiando a rojo
$Moto->aniadir_persona(70); // Añadiendo una persona de 70 kg
echo "Peso total de la moto después de añadir una persona: " . $Moto->getPeso() . " kg<br>";

// Cambiar color y añadir cilindrada
$Moto->setColor("Verde");
$Moto->setCilindrada(1000); // Añadiendo cilindrada

// Mostrar atributos de la moto
echo "<br>Atributos de la moto:<br>";
Vehiculo::ver_atributo($Moto);

// Crear un objeto Camion
$Camion = new Camion("Blanco", 6000, 10); // Color blanco y longitud 10
$Camion->aniadir_persona(84); // Añadiendo una persona de 84 kg
$Camion->repintar("Azul"); // Cambiando color a azul

// Mostrar atributos del camión
echo "<br>Atributos del camión:<br>";
Vehiculo::ver_atributo($Camion);

// Crear un objeto Coche
$SegundoVehiculo = new Coche("Verde", 1400, 0, 4); // Añadiendo 4 puertas
$SegundoVehiculo->aniadir_persona(65);
$SegundoVehiculo->aniadir_persona(65);
echo "<br>Atributos del coche:<br>";
echo $SegundoVehiculo; // Aquí se imprime el toString del coche
$SegundoVehiculo->repintar("Rojo"); // Repintar a rojo
$SegundoVehiculo->setNumeroCadenas(2); // Añadiendo cadenas de nieve

// Mostrar todos los atributos del coche
echo "<br>Atributos del coche:<br>";
Vehiculo::ver_atributo($SegundoVehiculo);

// Mostrar la información del camión
echo "<br>Atributos del camión después de las modificaciones:<br>";
echo $Camion; // Aquí se imprime el toString del camión
?>
