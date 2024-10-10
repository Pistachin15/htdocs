<?php
/*
Crea un array llamado deportes e introduce los siguientes valores: futbol,
baloncesto, natación, tenis. Haz el recorrido de la matriz con un for para mostrar
sus valores. A continuación realiza las siguientes operaciones
 Muestra el total de valores que contiene.
 Sitúa el puntero en el primer elemento del array y muestra el valor actual, es
decir, donde está situado el puntero actualmente.
 Avanza una posición y muestra el valor actual.
 Coloca el puntero en la última posición y muestra su valor.
 Retrocede una posición y muestra este valor.
*/

$deportes = array("futbol", "baloncesto", "natacion", "tenis");

for($i = 0; $i < count($deportes); $i++){
    echo "Valor $i: $deportes[$i]<br>";
}
echo "El total de valores del array deportes es de ". count($deportes). "<br>";

echo "El primer valor del array es ".reset($deportes)."<br>";
echo "El siguiente valor del array es ".next($deportes)."<br>";
echo "El ultimo valor del array es ".end($deportes)."<br>";
echo "El valor anterior es ".prev($deportes)."<br>";
?>