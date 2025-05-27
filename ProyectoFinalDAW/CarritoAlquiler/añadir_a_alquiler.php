<?php
session_start();

// ✅ Requiere iniciar sesión
if (!isset($_SESSION['nombreUsu'])) {
    header("Location: ../FormularioLoginRegistro/Logeo/login.php?mensaje=cesta");
    exit;
}

require_once '../login.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de producto inválido.");
}

$id = intval($_GET['id']);

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM productos WHERE id_producto = $id";
$res = $conn->query($sql);

if (!$res || $res->num_rows === 0) {
    die("Producto no encontrado.");
}

$producto = $res->fetch_assoc();
$conn->close();

// Inicializar cesta de alquiler si no existe
if (!isset($_SESSION['cesta_alquiler'])) {
    $_SESSION['cesta_alquiler'] = [];
}

$stock_disponible = $producto['stock'];

if (isset($_SESSION['cesta_alquiler'][$id])) {
    if ($_SESSION['cesta_alquiler'][$id]['cantidad'] < $stock_disponible) {
        $_SESSION['cesta_alquiler'][$id]['cantidad']++;
    } else {
        $_SESSION['error_stock_alquiler'] = "No hay suficiente stock para alquilar más unidades de '{$producto['titulo']}'.";
    }
} else {
    if ($stock_disponible > 0) {
        $_SESSION['cesta_alquiler'][$id] = [
            'titulo' => $producto['titulo'],
            'precio' => $producto['precio_alquiler'],
            'cantidad' => 1
        ];
    } else {
        $_SESSION['error_stock_alquiler'] = "El producto '{$producto['titulo']}' no tiene stock disponible para alquilar.";
    }
}


header('Location: ver_cesta_alquiler.php');
exit;
