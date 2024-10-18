<?php
include 'Ejercicio4.php';
$miVehiculo = new Vehiculo("negro", 1500);
$SegundoVehiculo = new Coche("verde", 1400, 0);
echo "Vehiculo<br>";
echo "---------------<br>";
echo $miVehiculo;
$miVehiculo->circula();
$miVehiculo->aniadir_persona(70);
echo $miVehiculo;
echo "<br>---------------<br>";
echo "Coche";
echo "<br>---------------<br>";
$SegundoVehiculo->aniadir_persona(65);
$SegundoVehiculo->aniadir_persona(65);
echo $SegundoVehiculo;
$SegundoVehiculo->repintar("rojo");
$SegundoVehiculo->aniadir_cadenas_nieve(2);
echo "<br>".$SegundoVehiculo;


?>