<?php
session_start();
require_once '../login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    echo "No tienes permisos para realizar esta acción.";
    exit;
}

if (isset($_POST['id_alquiler'], $_POST['id_producto'])) {
    $id_alquiler = $_POST['id_alquiler'];
    $id_producto = $_POST['id_producto'];

    $stmt = $conn->prepare("UPDATE alquileres SET devuelto = 1, fecha_devolucion = NOW() WHERE id_alquiler = ?");
    $stmt->bind_param("i", $id_alquiler);
    $stmt->execute();

    $stmt = $conn->prepare("UPDATE productos SET stock = stock + 1 WHERE id_producto = ?");
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();

    header("Location: alquileres_activos.php");
    exit;
} else {
    echo "Faltan datos.";
}
?>
