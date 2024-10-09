<?php
/*
Realiza el ejercicio anterior pero con la funicón array_push()
*/
$animales = ["Lagartija", "Araña", "Perro", "Gato", "Ratón"];

$numeros = [12, 34, 45, 52, 12];

$arboles = ["Sauce", "Pino", "Naranjo", "Chopo", "Perro", 34];

array_push($animales, 12, 34, 45, 52, 12, "Sauce", "Pino", "Naranjo", "Chopo", "Perro", 34);

echo "<ul>";
foreach ($animales  as $animales) {
    echo "<li>" . $animales . "</li>";
}
echo "</ul>";
?>