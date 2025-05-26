<?php
session_start();

// Validar parámetros
if (!isset($_GET['id']) || !isset($_GET['accion'])) {
    die("Parámetros inválidos.");
}

$id = intval($_GET['id']);
$accion = $_GET['accion'];

if (!isset($_SESSION['cesta_alquiler'][$id])) {
    die("Producto no encontrado en la cesta de alquiler.");
}

// Actualizar cantidad
switch ($accion) {
    case 'sumar':
        $_SESSION['cesta_alquiler'][$id]['cantidad']++;
        break;

    case 'restar':
        $_SESSION['cesta_alquiler'][$id]['cantidad']--;
        if ($_SESSION['cesta_alquiler'][$id]['cantidad'] <= 0) {
            unset($_SESSION['cesta_alquiler'][$id]);
        }
        break;

    default:
        die("Acción no válida.");
}

header('Location: ver_cesta_alquiler.php');
exit;
