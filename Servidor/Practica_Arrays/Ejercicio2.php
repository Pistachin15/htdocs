<?php
/*
Queremos almacenar en una matriz el número de alumnos con el que cuenta una
academia, ordenados en función del nivel y del idioma que se estudia. Tendremos
3 filas que representarán al Nivel básico, medio y de perfeccionamiento y 4
columnas en las que figurarán los idiomas (0 = Inglés, 1 = Francés, 2 = Alemán y 3
= Ruso). Mostrar por pantalla los alumnos que existen en cada nivel e idioma
*/


$AlumnosAcademia =  array('Básico' => array(1,14,8,3),
                            'Medio' => array(6, 19, 7, 2),
                            'Perfeccionamiento' => array(3, 13, 4, 1));
$Idiomas = array("Inglés", "Francés", "Alemán", "Ruso");

foreach ($AlumnosAcademia as $Dificultad => $alumnos) {
    $totalAlumnos = count($alumnos);
    echo "Total de alumnos en $Dificultad: $totalAlumnos\n<br>";

    foreach ($alumnos as $indice => $numeroAlumnos) {
        echo "Alumnos que van a " . $Idiomas[$indice] . ": $numeroAlumnos\n<br>";
    }
    
    echo "------------------\n"; 

}
?>