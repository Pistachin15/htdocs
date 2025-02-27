<?php
    // Inicia la sesión para poder acceder a las variables de sesión
    session_start();

    // Verifica si el botón "incrementar" fue presionado en el formulario
    if($_POST['incrementar']) {
        // Si la variable de sesión 'cont' ha alcanzado el límite de 5, redirige a agenda.php
        if($_SESSION['cont'] == 5) {
            header('Location: agenda.php');
            exit; // Termina la ejecución del script para evitar continuar ejecutando código
        }

        // Si el límite no se ha alcanzado, incrementa la variable de sesión 'cont'
        $_SESSION['cont']++;

        // Redirige al usuario de vuelta a inicio.php para reflejar el cambio
        header('Location: inicio.php');
        exit; // Asegura que no se ejecute más código después de la redirección
    } else {
        // Si no se presionó el botón "incrementar", redirige directamente a agenda.php
        header('Location: agenda.php');
        exit; // Finaliza el script
    }
?>
