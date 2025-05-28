<?php
session_start();
require_once "../../login.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador') {
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die("Error en la conexión");

    $id = intval($_POST['id_publicacion']);
    $stmt = $conn->prepare("DELETE FROM publicaciones WHERE id_publicacion = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: ../../index.php");
    exit();
} else {
    header("Location: ../../index.php");
    exit();
}
