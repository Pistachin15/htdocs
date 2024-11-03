<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Dinámico</title>
</head>
<body>
    <article>
        <form action="#" method="post" class="mi-formulario">
            <label for="num">Número de elementos:</label>
            <input type="text" id="num" name="num" required><br>
            <input type="submit" value="Enviar" name="boton">
        </form>

        <?php
        if (isset($_POST['boton'])) {
            $num = (int)$_POST["num"]; 

            echo '<form action="#" method="post" class="mi-formulario">'; 

            for ($i = 1; $i <= $num; $i++) {
                echo "<label for='valores$i'>Número $i:</label>";
                echo "<input type='text' id='valores$i' name='valores[]' required><br>";
            }

            echo "<input type='submit' value='Calcular' name='calcular'>";
            echo "</form>"; 
        }

        if (isset($_POST['calcular'])) {
            $valores = $_POST['valores']; 
            $num = count($valores); 
            $sumaTotal = array_sum($valores); 


            echo "<h3>Tamaño del vector: $num</h3>";
            echo "<h3>Valores en cada posición:</h3>";
            foreach ($valores as $index => $valor) {
                echo "Posición " . ($index + 1) . ": $valor<br>";
            }
            echo "<h3>Suma de los valores: $sumaTotal</h3>";
        }
        ?>
    </article>
</body>
</html>
