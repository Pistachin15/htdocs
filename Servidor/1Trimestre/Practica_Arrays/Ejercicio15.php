<?php
/*
Crea un array con los nombre Pedro, Ismael, Sonia, Clara, Susana, Alfonso y
Teresa. Muestra el número de elementos que contiene y cada elemento en una
lista no numerada de html.
*/


$nombres = array("Pedro", "Ismael", "Sonia", "Clara", "Susana", "Alfonso", "Teresa");

echo "El array contiene " . count($nombres) . " elementos.<br><br>";

echo "<ul>";
foreach ($nombres as $nombre) {
    echo "<li>" . $nombre . "</li>";
}
echo "</ul>";


?>