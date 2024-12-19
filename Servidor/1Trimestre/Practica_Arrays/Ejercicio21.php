<?php

$numeros = array(3, 2, 8, 123, 5, 1);


sort($numeros);


echo "<table >";
echo "<tr><th>Números</th></tr>";

foreach ($numeros as $numero) {
    echo "<tr><td>$numero</td></tr>";
}

echo "</table>";
?>
