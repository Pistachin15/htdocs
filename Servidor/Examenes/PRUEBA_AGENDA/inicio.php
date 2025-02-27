<?php
    // Inicia la sesión para acceder a las variables de sesión
    session_start();

    // Array con etiquetas <img> que contienen imágenes predefinidas
    $img = [
        '<img src="img/OIP0.jfif">', 
        '<img src="img/OIP1.jfif">', 
        '<img src="img/OIP2.jfif">', 
        '<img src="img/OIP3.jfif">', 
        '<img src="img/OIP4.jfif">'
    ];

    // Verifica si la variable de sesión 'cont' no está definida o es igual a 1
    if (!isset($_SESSION['cont']) || $_SESSION['cont'] == 1) {
        // Selecciona aleatoriamente 5 imágenes y las almacena en la sesión
        $_SESSION['imgs'] = [
            $img[array_rand($img)], 
            $img[array_rand($img)], 
            $img[array_rand($img)], 
            $img[array_rand($img)], 
            $img[array_rand($img)]
        ];

        // Inicializa el contador de contactos en 1
        $_SESSION['cont'] = 1;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGENDA</title>
</head>
<body>
    <!-- Título de la agenda -->
    <h1>Agenda</h1>

    <!-- Instrucciones para el usuario -->
    <p>Hola, ¿cuántos contactos deseas grabar?</p>
    <p>Puedes grabar entre 1 y 5. Por cada posición en "INCREMENTAR" grabarás un usuario más.</p>
    <p>Cuando el número sea el deseado, pulsa "GRABAR".</p>

    <?php
        // Muestra las imágenes almacenadas en la sesión hasta la cantidad indicada en 'cont'
        for ($i = 0; $i < $_SESSION['cont']; $i++) {
            echo $_SESSION['imgs'][$i];
        }
    ?>

    <!-- Formulario con botones para incrementar el número de contactos o grabarlos -->
    <form action="comprobar.php" method="post">
        <input type="submit" value="Incrementar" name="incrementar">
        <input type="submit" value="Grabar" name="grabar">
    </form>
</body>
</html>
