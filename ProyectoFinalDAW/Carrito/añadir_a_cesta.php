<?php
session_start();

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

if (!isset($_SESSION['cesta'])) {
    $_SESSION['cesta'] = [];
}

$stock_disponible = $producto['stock'];

if (isset($_SESSION['cesta'][$id])) {
    if ($_SESSION['cesta'][$id]['cantidad'] < $stock_disponible) {
        $_SESSION['cesta'][$id]['cantidad']++;
    } else {
        $_SESSION['error_stock'] = "No hay suficiente stock para añadir más unidades de '{$producto['titulo']}'.";
    }
} else {
    if ($stock_disponible > 0) {
        $_SESSION['cesta'][$id] = [
            'titulo' => $producto['titulo'],
            'precio' => $producto['precio_compra'],
            'cantidad' => 1
        ];
    } else {
        $_SESSION['error_stock'] = "El producto '{$producto['titulo']}' no tiene stock disponible.";
    }
}


if ($producto['tipo'] === 'videojuego') {
    $_SESSION['origen_catalogo'] = '../catalogo/catalogo_videojuegos.php';
} elseif ($producto['tipo'] === 'película') {
    $_SESSION['origen_catalogo'] = '../catalogo/catalogo_peliculas.php';
}

header('Location: ver_cesta.php');
exit;
