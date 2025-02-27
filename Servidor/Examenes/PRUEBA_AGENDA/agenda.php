<?php
    // Inicia la sesión para poder acceder a las variables de sesión
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
</head>
<body>
    <!-- Muestra un encabezado de bienvenida con el nombre del usuario almacenado en la sesión -->
    <h1>Hola <?php echo $_SESSION['usuario']?></h1>
    
    <?php
    // Inicia el formulario que enviará los datos a grabado.php mediante el método POST
    echo '<form action="grabado.php" method="post">';

        // Se recorre un bucle basado en el número de contactos almacenados en la sesión
        for($i = 0; $i < $_SESSION['cont']; $i++){
            $j = $i + 1; // Se usa $j para mostrar números de contacto desde 1 en adelante

            // Se genera dinámicamente un fieldset con inputs para cada contacto
            echo "
            <fieldset>Contacto {$j}<br>
            <label for='nombre{$j}'>Nombre {$j}:</label>
            <input type='text' name='nombre{$j}' id='nombre{$j}' required><br>
            
            <label for='email{$j}'>Email {$j}:</label>
            <input type='email' name='email{$j}' id='email{$j}' required><br>
            
            <label for='telefono{$j}'>Teléfono {$j}:</label>
            <input type='tel' name='telefono{$j}' id='telefono{$j}' required><br>
            </fieldset>
        ";
        }

        // Botón de envío para guardar los datos ingresados en el formulario
        echo '<input type="submit" value="grabar" name="grabar">';
        echo '</form>';
    ?>
</body>
</html>
