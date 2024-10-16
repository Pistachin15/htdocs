<?php
include 'Ejercicio3.php';
$miVehiculo = new Vehiculo("negro", 1500);
echo $miVehiculo;
$miVehiculo->circula();
$miVehiculo->aniadir_persona(70);
echo $miVehiculo;



?>