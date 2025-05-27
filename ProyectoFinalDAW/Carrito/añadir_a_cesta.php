<?php
session_start();

// ✅ Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombreUsu'])) {
    // Redirigir al login con un mensaje
    header("Location: ../FormularioLoginRegistro/Logeo/login.php?mensaje=cesta");
    exit;
}

require_once '../login.php';

// Validar ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de producto inválido.");
}

$id = intval($_GET['id']);

// Conectar a la base de datos
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Buscar el producto
$sql = "SELECT * FROM productos WHERE id_producto = $id";
$res = $conn->query($sql);

if (!$res || $res->num_rows === 0) {
    die("Producto no encontrado.");
}

$producto = $res->fetch_assoc();
$conn->close();

// Inicializar cesta si no existe
if (!isset($_SESSION['cesta'])) {
    $_SESSION['cesta'] = [];
}

// Añadir o actualizar producto en la cesta
$stock_disponible = $producto['stock'];

if (isset($_SESSION['cesta'][$id])) {
    if ($_SESSION['cesta'][$id]['cantidad'] < $stock_disponible) {
        $_SESSION['cesta'][$id]['cantidad']++;
    } else {
        // No se puede añadir más del stock disponible
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


// Guardar origen para "seguir comprando" desde ver_cesta
if ($producto['tipo'] === 'videojuego') {
    $_SESSION['origen_catalogo'] = '../catalogo/catalogo_videojuegos.php';
} elseif ($producto['tipo'] === 'película') {
    $_SESSION['origen_catalogo'] = '../catalogo/catalogo_peliculas.php';
}

// Redirigir a la vista de la cesta
header('Location: ver_cesta.php');
exit;
