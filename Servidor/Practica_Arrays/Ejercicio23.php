<?php
/*
Crea un array multidimensional para poder guardar los componentes de dos
familias: “Los Simpson” y “Los Griffin” dentro de cada familia ha de constar el
padre, la madres y los hijos, donde padre, madre e hijos serán los índices y los
índices y los nombres serán los valores. Esta estructura se ha de crear en un solo
array asociativo de tres dimensiones.
*/
$familias = array(
    "Los Simpson" => array(
        "padre" => "Homer Simpson",
        "madre" => "Marge Simpson",
        "hijos" => array("Bart Simpson", "Lisa Simpson", "Maggie Simpson")
    ),
    "Los Griffin" => array(
        "padre" => "Peter Griffin",
        "madre" => "Lois Griffin",
        "hijos" => array("Chris Griffin", "Meg Griffin", "Stewie Griffin")
    )
);

// Mostrar el contenido en listas no numeradas
foreach ($familias as $familia => $miembros) {
    echo "<h3>Familia: $familia</h3>";
    echo "<ul>";
    echo "<li>Padre: " . $miembros["padre"] . "</li>";
    echo "<li>Madre: " . $miembros["madre"] . "</li>";
    echo "<li>Hijos: " . implode(", ", $miembros["hijos"]) . "</li>";
    echo "</ul>";
}
?>
