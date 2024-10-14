<?php
/*
Crea una matriz para guardar a los amigos clasificados por diferentes ciudades.
Los valores serán los siguientes:
Haz un recorrido del array multidimensional mostrando los valores de tal manera
que nos muestre en cada ciudad que amigos tiene.
*/

$Personas = array("Madrid" => array("nombre" => "Pedro",
                                    "edad" => 32,
                                    "telefono" => "91-999.99.99"),
                "Barcelona" => array("nombre" => "Susana",
                                    "edad" => 34,
                                    "telefono" => "93-000.00.00"),
                "Toledo" => array("nombre" => "Sonia",
                                    "edad" => 42,
                                    "telefono" => "925-09.09.09"));

echo "<ul>";
foreach ($Personas as $Provincia => $Datos) {

    echo "<h3>: $Provincia</h3>";
    foreach ($Datos as $dato => $datoAmigo){
        echo "<li>$dato : $datoAmigo</li>";
    }
}
"</ul>"
?>