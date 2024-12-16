<?php
    /*
        Después de analizar las funciones anteriores que resultado produciría la siguiente
        función:
            function test_entrada($valor) {
                $valor = trim($valor);
                $valor = stripslashes($valor);
                return $valor;
            }
    */
    function test_entrada($valor) {
        $valor = trim($valor);
        $valor = stripslashes($valor);
        return $valor;
    }

    $valor = " Es tu nombre O\'reilly? ";
    echo test_entrada($valor);

    // Quita tanto los espacios del principio y del final 
?>