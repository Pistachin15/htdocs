<?php
/*
Escribe un script para probar algunas de las funciones mostradas debajo, el sript
ha de contener al menos tres funciones de cada bloque
*/

function procesarArray($array) {
    // Ordenar el array por claves
    ksort($array);
    echo "Array ordenado por claves:\n";
    print_r($array);

    // Ordenar el array por valores
    sort($array);
    echo "Array ordenado por valores:\n";
    print_r($array);

    // Contar elementos en el array
    $count = count($array);
    echo "Número de elementos en el array: $count\n";
}

// Ejemplo de uso
$array = [
    "b" => 2,
    "a" => 1,
    "c" => 3,
    "e" => 5,
    "d" => 4
];

procesarArray($array);
?>
