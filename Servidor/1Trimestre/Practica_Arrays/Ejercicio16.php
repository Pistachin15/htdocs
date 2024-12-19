<?php
/*
Crea un array llamado “lenguajes_cliente” y otro “lenguajes_servidor”, crea tu
mismo los valores, poniendo índices alfanuméricos a cada valor con tres
elementos cada uno. Junta ambos arrays en uno solo llamado “lenguajes” y
muéstralo por pantalla en una tabla
*/


$lenguajes_cliente = array(
    "js" => "JavaScript",
    "html" => "HTML",
    "css" => "CSS"
);
$lenguajes_servidor = array(
    "php" => "PHP",
    "py" => "Python",
    "rb" => "Ruby"
);

$lenguajes_servidor = $lenguajes_servidor + $lenguajes_cliente;

echo "<ul>";
foreach ($lenguajes_servidor as $lenguaje => $Lenguaje) {
    echo "<li>" . $lenguaje ." : ". $Lenguaje . "</li>";
}
echo "</ul>";

?>