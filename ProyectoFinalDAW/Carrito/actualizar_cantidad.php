<?php
session_start();

if (!isset($_GET['id']) || !isset($_GET['accion'])) {
    die("Parámetros inválidos.");
}

$id = intval($_GET['id']);
$accion = $_GET['accion'];

if (!isset($_SESSION['cesta'][$id])) {
    die("Producto no encontrado en la cesta.");
}

switch ($accion) {
    case 'sumar':
        $_SESSION['cesta'][$id]['cantidad']++;
        break;

    case 'restar':
        $_SESSION['cesta'][$id]['cantidad']--;

        // Si la cantidad llega a 0 o menos, eliminamos el producto de la cesta
        if ($_SESSION['cesta'][$id]['cantidad'] <= 0) {
            unset($_SESSION['cesta'][$id]);
        }
        break;

    default:
        die("Acción no válida.");
}

header('Location: ver_cesta.php');
exit;
