<?php
    /*
        Dada la siguiente línea de código $valor = " Es tu nombre O\'reilly? ";
             Evalúa que resultado produce la siguiente línea de código e indica qué valor tiene
            la variable $resultado.
                $resultado = trim($valor);
             Evalúa que resultado produce la siguiente línea de código e indica qué valor tiene
            la variable $resultado.
                $resultado = stripslashes($valor);
    */

    $valor = " Es tu nombre O\'reilly? ";
    echo $valor."<br>";

    $resultado = trim($valor);
    echo $resultado."<br>";
    // Quita los espacios del principio y del final
    $resultado = stripslashes($valor);
    echo $resultado."<br>";
    // Quita las barras invertidas pero deja los espacios;

?>