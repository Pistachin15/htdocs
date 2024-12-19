<?php
/*
        Evalúa el siguiente código PHP e indica que hace, ¿para qué sirve la función
        filter_var?, ¿qué parámetros necesita y qué retorna?
            <?php
            $email="abc@abc.com";
            $emailErr="Email correcto";
            if (empty($email)) {
            $emailErr = "Se requiere Email";
            } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Fomato de Email invalido";
            }
            }
            echo $email;
            echo "<br>";
            echo $emailErr;
            ?>
    */

    $email = "abc@abc.com";
    $emailErr = "Email correcto";
    if (empty($email)) {
        $emailErr = "Se requiere Email";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Fomato de Email invalido";
        }
    }
    echo $email;
    echo "<br>";
    echo $emailErr;

    /* 
        El programa valida si la variable $email esta vacia y si no comprueba si $email tiene un formato valido 
        y luego muestra por pantalla el $email y $emailErr que cambia en funcio de si la variable esta vacia o 
        si el formato no es valido 
    */

    //filter_var filtra una variable con el filtro que se indique, necesita la variable a filtrar y el tipo de filtro como parametros y devuelve la variable filtrada o false si el filtro falla
?>
