<?php
/*
Muestra los valores del array en una tabla, has de mostrar el índice y el valor
asociado.
 Elimina el estadio asociado al Real Madrid.
 Vuelve a mostrar los valores para comprobar que el valor ha sido eliminado, esta
vez en una lista numerada.
*/
$estadios_futbol = array(
    "Barcelona" => "Camp Nou",
    "Real Madrid" => "Santiago Bernabeu",
    "Valencia" => "Mestalla",
    "Real Sociedad" => "Anoeta"
);

echo "<h3>Estadios de fútbol en tabla:</h3>";
echo "<table border='1'>";
echo "<tr><th>Equipo</th><th>Estadio</th></tr>";
foreach ($estadios_futbol as $equipo => $estadio) {
    echo "<tr><td>$equipo</td><td>$estadio</td></tr>";
}
echo "</table>";

unset($estadios_futbol["Real Madrid"]);

// Mostrar los valores del array actualizado en una lista numerada
echo "<h3>Estadios de fútbol (Real Madrid eliminado) en lista numerada:</h3>";
echo "<ol>";
foreach ($estadios_futbol as $equipo => $estadio) {
    echo "<li>$equipo: $estadio</li>";
}
echo "</ol>";
?>
