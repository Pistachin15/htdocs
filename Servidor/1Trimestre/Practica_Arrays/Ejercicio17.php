<?php
/*
Rellena los siguientes tres arrays y júntalos en uno nuevo. Muéstralos por
pantalla. Utiliza la función array_merge()
*/
$animales = ["Lagartija", "Araña", "Perro", "Gato", "Ratón"];

$numeros = [12, 34, 45, 52, 12];

$arboles = ["Sauce", "Pino", "Naranjo", "Chopo", "Perro", 34];

$resultado = array_merge($animales, $numeros, $arboles);

echo "<ul>";
foreach ($resultado  as $resultado) {
    echo "<li>" . $resultado . "</li>";
}
echo "</ul>";
?>