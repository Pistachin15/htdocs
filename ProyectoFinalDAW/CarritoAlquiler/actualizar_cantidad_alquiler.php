<?php
session_start();

if (!isset($_GET['id']) || !isset($_GET['accion'])) {
    die("Parámetros inválidos.");
}

$id = intval($_GET['id']);
$accion = $_GET['accion'];

if (!isset($_SESSION['cesta_alquiler'][$id])) {
    die("Producto no encontrado en la cesta de alquiler.");
}

switch ($accion) {
    case 'sumar':
    require_once '../login.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $sql = "SELECT stock FROM productos WHERE id_producto = $id";
    $res = $conn->query($sql);
    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $stock_disponible = $row['stock'];
        if ($_SESSION['cesta_alquiler'][$id]['cantidad'] < $stock_disponible) {
            $_SESSION['cesta_alquiler'][$id]['cantidad']++;
        } else {
            $_SESSION['error_stock_alquiler'] = "Has alcanzado el límite de stock disponible para alquiler.";
        }
    }
    $conn->close();
    break;


    case 'restar':
        $_SESSION['cesta_alquiler'][$id]['cantidad']--;
        if ($_SESSION['cesta_alquiler'][$id]['cantidad'] <= 0) {
            unset($_SESSION['cesta_alquiler'][$id]);
        }
        break;

    default:
        die("Acción no válida.");
}

header('Location: ver_cesta_alquiler.php');
exit;
