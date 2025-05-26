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

if (isset($_SESSION['cesta_alquiler'][$id])) {
    $_SESSION['cesta_alquiler'][$id]['cantidad']++;
} else {
    $_SESSION['cesta_alquiler'][$id] = [
        'titulo' => $producto['titulo'],
        'precio' => $producto['precio_alquiler'],
        'cantidad' => 1
    ];
}

header('Location: ver_cesta_alquiler.php');
exit;
