<?php
session_start();
require_once '../login.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    echo "No tienes permisos para realizar esta acción.";
    exit;
}

if (isset($_POST['id_alquiler'], $_POST['id_producto'])) {
    $id_alquiler = $_POST['id_alquiler'];
    $id_producto = $_POST['id_producto'];

    // Marcar como devuelto
    $stmt = $conn->prepare("UPDATE alquileres SET devuelto = 1, fecha_devolucion = NOW() WHERE id_alquiler = ?");
    $stmt->bind_param("i", $id_alquiler);
    $stmt->execute();

    // Aumentar stock
    $stmt = $conn->prepare("UPDATE productos SET stock = stock + 1 WHERE id_producto = ?");
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();

    echo "Alquiler finalizado correctamente. <a href='alquileres_activos.php'>Volver</a>";
} else {
    echo "Faltan datos.";
}
?>
