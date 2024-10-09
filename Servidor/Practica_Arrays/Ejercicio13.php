<?php
/*
Crea un array introduciendo las ciudades: Madrid, Barcelona, Londres, New York,
Los Ángeles y Chicago, sin asignar índices al array. A continuación, muestra el
contenido del array haciendo un recorrido diciendo el valor correspondiente a
cada índice.
*/
$Ciudades = ["Madrid", "Barcelona", "Londres", "New York", "Los Ángeles", "Chicago"];

for ($i = 0; $i < count($Ciudades); $i++){
    echo "La ciudad con el índice $i tiene el nombre de $Ciudades[$i]<br>";
}
?>