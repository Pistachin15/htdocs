<?php
session_start();
require_once '../login.php';

// Recoger datos del formulario
$tipo = $_POST['tipo'] ?? '';
$nombre = trim($_POST['nombre'] ?? '');
$tarjeta = trim($_POST['tarjeta'] ?? '');
$caducidad = trim($_POST['caducidad'] ?? '');
$cvv = trim($_POST['cvv'] ?? '');

// Validación básica de formato
if (!in_array($tipo, ['compra', 'alquiler']) ||
    empty($nombre) || !preg_match('/^[\p{L}\s]+$/u', $nombre) ||
    !preg_match('/^\d{16}$/', $tarjeta) ||
    !preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $caducidad) ||
    !preg_match('/^\d{3}$/', $cvv)) {
    $_SESSION['error_pago'] = "Datos de pago inválidos. Revisa los campos.";
    header("Location: formulario_pago.php?tipo=$tipo");
    exit;
}

// Validar que la tarjeta no esté caducada
list($mes, $anio) = explode('/', $caducidad);
$mes = (int)$mes;
$anio = (int)$anio;
$anio_actual = (int) date('y');
$mes_actual = (int) date('m');

if ($anio < $anio_actual || ($anio === $anio_actual && $mes < $mes_actual)) {
    $_SESSION['error_pago'] = "La tarjeta está caducada.";
    header("Location: formulario_pago.php?tipo=$tipo");
    exit;
}

// Obtener la cesta según el tipo
$cesta = $tipo === 'compra' ? ($_SESSION['cesta'] ?? []) : ($_SESSION['cesta_alquiler'] ?? []);
if (empty($cesta)) {
    $_SESSION['error_pago'] = "Tu cesta está vacía.";
    header("Location: formulario_pago.php?tipo=$tipo");
    exit;
}

// Obtener ID del usuario
$id_usuario = $_SESSION['id_usu'] ?? 0;
if (!$id_usuario || !is_numeric($id_usuario)) {
    $_SESSION['error_pago'] = "Usuario no identificado.";
    header("Location: formulario_pago.php?tipo=$tipo");
    exit;
}

// Conectar a la base de datos
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    $_SESSION['error_pago'] = "Error de conexión con la base de datos.";
    header("Location: formulario_pago.php?tipo=$tipo");
    exit;
}

// Procesar productos
foreach ($cesta as $id => $producto) {
    $res = $conn->query("SELECT stock FROM productos WHERE id_producto = $id");
    if (!$res || $res->num_rows === 0) continue;

    $stock = $res->fetch_assoc()['stock'];
    if ($stock < $producto['cantidad']) {
        $_SESSION['error_pago'] = "Stock insuficiente para " . htmlspecialchars($producto['titulo']);
        header("Location: formulario_pago.php?tipo=$tipo");
        exit;
    }

    // Actualizar stock
    $nuevo_stock = $stock - $producto['cantidad'];
    $conn->query("UPDATE productos SET stock = $nuevo_stock WHERE id_producto = $id");

    // Registrar la operación
    if ($tipo === 'compra') {
        $total = $producto['precio'] * $producto['cantidad'];
        $cantidad = $producto['cantidad'];
        $conn->query("INSERT INTO compras (id_usuario, id_producto, cantidad, total)
                    VALUES ($id_usuario, $id, $cantidad, $total)");
    } else {
        for ($i = 0; $i < $producto['cantidad']; $i++) {
            $conn->query("INSERT INTO alquileres (id_usuario, id_producto)
                        VALUES ($id_usuario, $id)");
        }
    }
}

$conn->close();

// Vaciar la cesta correspondiente
if ($tipo === 'compra') {
    unset($_SESSION['cesta']);
} else {
    unset($_SESSION['cesta_alquiler']);
}

// Redirigir a mensaje de éxito
header("Location: compra_exitosa.php?tipo=$tipo");
exit;
