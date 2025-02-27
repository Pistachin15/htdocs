<?php 
    // Inicia la sesión para poder acceder a las variables de sesión
    session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
</head>
<body>
    <!-- Título principal de la página -->
    <h1>AGENDA DE CONTACTOS</h1>

    <!-- Formulario de inicio de sesión que envía los datos a validacion.php mediante POST -->
    <form method="post" action="validacion.php">

        <!-- Verifica si existe un mensaje de error en la sesión y lo muestra si es igual a 1 -->
        <?php 
            if(isset($_SESSION['error'])) { 
                if($_SESSION['error'] == 1) { 
                    echo "<span style='color:red;'>Datos Incorrectos</span><br>"; 
                } 
            } 
        ?>

        <!-- Campo de entrada para el usuario -->
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required><br>

        <!-- Campo de entrada para la contraseña -->
        <label for="clave">Clave:</label>
        <input type="password" id="clave" name="clave" required><br>

        <!-- Botón para enviar el formulario -->
        <input type="submit" value="Enviar" name="enviar">
    </form>
</body>
</html>
