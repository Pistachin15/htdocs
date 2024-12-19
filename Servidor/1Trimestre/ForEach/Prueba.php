<?php
$mascotas = array('Perro' => array('Mastín' => "Yunito",
                                'Salchica' => "Fuet",
                                'Chiguagua' => "Sarnoso"),
                    'Gatos' => array('Persa' => "Otis",
                                    'Común' => "Garfield",
                                    'Siamés' => "Princesa"));

foreach($mascotas as $animal => $tipo)
    echo $animal.": <br>";
    foreach($tipo as $raza => $nombre)
    echo $raza.": ".$nombre."<br>";

?>