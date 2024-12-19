<?php
/*
Crea un array con los siguientes valores: 5->1, 12->2, 13->56, x->42. Muestra el
contenido. Cuenta el número de elementos que tiene y muéstralo por pantalla. A
continuación borrar el contenido de posición 5. Vuelve a mostrar el contenido y
por último elimina el array.
*/
$array = array(
    5 => 1,
    12 => 2,
    13 => 56,
    'x' => 42
);


echo "Contenido del array:<br>";
foreach ($array as $key => $value) {
    echo "$key => $value<br>";
}


$numElementos = count($array);
echo "<br>Número de elementos: $numElementos<br>";


unset($array[5]);


echo "<br>Contenido del array después de eliminar la posición 5:<br>";
foreach ($array as $key => $value) {
    echo "$key => $value<br>";
}


$array = null;
echo "<br>El array ha sido eliminado.";
?>
