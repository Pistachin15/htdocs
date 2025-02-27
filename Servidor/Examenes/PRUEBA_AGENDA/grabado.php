<?php
    // Incluye el archivo de configuración de la base de datos
    require_once 'datdb.php';

    // Inicia la sesión para acceder a las variables de sesión
    session_start();

    // Conexión a la base de datos usando las credenciales de datdb.php
    // Se especifica el puerto 3307 en la conexión
    $ctdb = new mysqli($hn, $user, $pw, $db, 3307);

    // Verifica si hubo un error en la conexión y termina el script si es así
    if ($ctdb->connect_error) die("Error connecting");

    // Consulta SQL para obtener el código del usuario actual usando su nombre de sesión
    $qryUsuario = "SELECT codigo FROM usuarios WHERE Nombre='{$_SESSION['usuario']}'";
    $us = $ctdb->query($qryUsuario);

    // Obtiene el código del usuario desde el resultado de la consulta
    $codigousu = $us->fetch_assoc()['codigo'];

    // Bucle para procesar todos los contactos almacenados en la sesión
    for ($i = 1; $i <= $_SESSION['cont']; $i++) {
        // Obtiene los datos enviados en el formulario y los escapa para evitar inyección SQL
        $nombre = $ctdb->real_escape_string($_POST['nombre'.$i]);
        $email = $ctdb->real_escape_string($_POST['email'.$i]);
        $telefono = $ctdb->real_escape_string($_POST['telefono'.$i]);

        // Inserta cada contacto en la base de datos, vinculándolo al usuario actual
        $qryInsert = "INSERT INTO contactos (nombre, email, telefono, codusuario) 
                      VALUES ('$nombre', '$email', '$telefono', $codigousu)";
        
        // Ejecuta la consulta e imprime un mensaje de error si falla
        if (!$ctdb->query($qryInsert)) {
            die("Error executing query: " . $ctdb->error);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
</head>
<body>
    <!-- Muestra un mensaje de bienvenida al usuario -->
    <h1>Hola <?php echo $_SESSION['usuario']?></h1>    

    <!-- Mensaje de confirmación de contactos guardados -->
    <p>Se han grabado <?php echo $_SESSION['cont']?> contactos de <?php echo $_SESSION['usuario']?></p>

    <!-- Enlaces de navegación -->
    <a href="index.php">Volver a logearse</a>
    <a href="inicio.php">Introducir más contactos para <?php echo $_SESSION['usuario']?></a>
    <a href="totales.php">Total de contactos guardados</a>
</body>
</html>
