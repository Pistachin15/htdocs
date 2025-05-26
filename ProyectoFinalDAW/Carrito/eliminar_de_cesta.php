<?php
session_start();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}

$id = intval($_GET['id']);

if (isset($_SESSION['cesta'][$id])) {
    unset($_SESSION['cesta'][$id]);
}

header('Location: ver_cesta.php');
exit;
