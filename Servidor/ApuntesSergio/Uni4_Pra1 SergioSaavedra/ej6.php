<?php
/*
    Se ha de crear un formulario con una caja de texto y un botón ACEPTAR, según el
    valor introducido en la caja de texto se han de mostrar los elementos indicados, a
    partir de ahí la web se ha de comportar igual que el ejercicio anterior, se ha de
    resolver con un sólo script.
*/
echo<<<_END
<form action="#" method="post">
<label for="num">Numero de Elementos:</label>
<input type="number" id="num" name="num" required>
<input type="submit" value="Aceptar">
</form>
_END;
if (isset($_POST['0'])) {
    $suma = 0;
    foreach ($_POST as $indice => $valor) {
        echo "$indice: $valor <br>";
        $suma = $suma+$valor;
    }
    echo "El nuero de valores es ".count($_POST)."<br>";
    echo "La suma es $suma";
} else if (isset($_POST['num'])) {
    echo<<<_END
<br>
<form action="#" method="post">
_END;

for ($i=0; $i<$_POST['num'];$i++) {
    
    echo<<<_END
        <label for="$i">$i:</label>
        <input type="number" id="num1" name="$i" required>
        <br>
    _END;
}
echo<<<_END
    <input type="submit" value="Enviar">
_END;
echo "</form>";
}

?>