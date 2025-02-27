<?php
    // Inicia la sesión para poder usar variables de sesión
    session_start();

    // Inicializa la variable de sesión 'error' en 0 (sin errores)
    $_SESSION['error'] = 0;
    
    // Incluye el archivo de configuración de la base de datos
    require_once 'datdb.php';

    // Crea una conexión a la base de datos
    $ctdb = new mysqli($hn, $user, $pw, $db);

    // Verifica si la conexión tuvo un error
    if ($ctdb->connect_error) {
        die("Error connecting"); // Termina el script si hay un error de conexión
    } else {
        // Verifica si el formulario fue enviado
        if (isset($_POST['enviar'])) {
            // Obtiene los valores ingresados por el usuario
            $usuarioValidar = $_POST['usuario'];
            $claveValidar = $_POST['clave'];

            // Consulta SQL para verificar si el usuario y la clave existen en la base de datos
            $qrySelect = "SELECT Nombre, Clave FROM usuarios WHERE Nombre = '$usuarioValidar' AND Clave = '$claveValidar'";

            // Ejecuta la consulta
            $result = $ctdb->query($qrySelect);

            // Cierra la conexión con la base de datos
            $ctdb->close();

            // Si hay al menos una coincidencia, el usuario es válido
            if ($result->num_rows > 0) {
                // Guarda el nombre de usuario en la sesión
                $_SESSION['usuario'] = $usuarioValidar;

                // Redirige a la página de inicio
                header('Location: inicio.php');
                exit; // Finaliza la ejecución del script
            } else {
                // Si los datos son incorrectos, establece el error en la sesión y redirige al login
                $_SESSION['error'] = 1;
                header('Location: index.php');
                exit;
            }
        }
    }
?>
