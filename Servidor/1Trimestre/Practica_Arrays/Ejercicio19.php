<?php
/*
Muestra los arrays combinados del ejercicio anterior pero en orden inverso
*/
$animales = ["Lagartija", "Araña", "Perro", "Gato", "Ratón"];
$numeros = [12, 34, 45, 52, 12];
$arboles = ["Sauce", "Pino", "Naranjo", "Chopo", "Perro", 34];

$array_combinado = array_merge($animales, $numeros, $arboles);
$array_invertido = array_reverse($array_combinado);

echo "<ul>";
foreach ($array_invertido as $elemento) {
    echo "<li>" . $elemento . "</li>";
}
echo "</ul>";
?>
