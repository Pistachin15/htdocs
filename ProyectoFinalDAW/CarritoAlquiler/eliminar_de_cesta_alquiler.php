<?php
session_start();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}

$id = intval($_GET['id']);

if (isset($_SESSION['cesta_alquiler'][$id])) {
    unset($_SESSION['cesta_alquiler'][$id]);
}

header('Location: ver_cesta_alquiler.php');
exit;
