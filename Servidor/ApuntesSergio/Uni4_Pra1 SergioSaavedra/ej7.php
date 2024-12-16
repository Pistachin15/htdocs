<?php
    /*
        Igual que el ejercicio anterior, pero han de aparecer cargados los valores de ejecución
        en las nuevas cajas de texto, se ha de resolver con un sólo script.
    */
    
    echo<<<_END
    <form action="#" method="post">
    _END;
    $repAnterior = isset($_POST['num']) ? $_POST['num'] : ''; 
    echo<<<_END
    <label for="num">Numero de Elementos:</label>
    <input type="number" id="num" name="num" value="$repAnterior" required>
    
    _END;

    
    if (isset($_POST['0'])) {
        $suma = 0;
        foreach ($_POST as $indice => $valor) {
            if ($indice != "num") {
                echo "$indice: $valor <br>";
                $suma = $suma+$valor;
            }
            
        }
        echo "La suma es $suma";
    } 
    if (isset($_POST['num']) || isset($suma)) {
        echo<<<_END
    <br>
    <br>
    _END;

    
    
    for ($i=0; $i<$_POST['num'];$i++) {
        $valorAnterior = isset($_POST[$i]) ? $_POST[$i] : '';
        echo<<<_END
            <label for="$i">$i:</label>
            <input type="number" id="num1" name="$i" value="$valorAnterior" required>
            <br>
        _END;
    }
    echo<<<_END
        
    _END;
    
    }

    echo<<<_END
        <input type="submit" value="Enviar">

        </form>
    _END;
