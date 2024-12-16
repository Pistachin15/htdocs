<?php
    /*
        Crear un formulario (se ha de hacer con un bucle FOR con el que se crearán las 9
        cajas de texto), además tendrá un botón ENVIAR que al pulsarlo mostrará los
        elementos del vector y su suma. Debajo del resultado se han de mostrar de nuevo las
        9 cajas de texto para poder repetir el proceso, se ha de resolver con un script:
    */

    if (isset($_POST['0'])) {
        $suma = 0;
        foreach ($_POST as $indice => $valor) {
            echo "$indice: $valor <br>";
            $suma = $suma+$valor;
        }
        echo "La suma es $suma";
    }
    echo<<<_END
    <br>
    <form action="#" method="post">
    _END;
    
    for ($i=0; $i<10;$i++) {
        
        echo<<<_END
            <label for="$i">$i:</label>
            <input type="text" id="num1" name="$i" required>
            <br>
        _END;
    }
    echo<<<_END
        <input type="submit" value="Enviar">
    _END;
    echo "</form>";
?>