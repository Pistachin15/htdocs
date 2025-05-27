<?php
session_start();
require_once '../login.php'; // Asegúrate de que aquí se define $conexion

if (!isset($_SESSION['nombreUsu'])) {
    header("Location: ../FormularioLoginRegistro/Logeo/login.php?mensaje=cesta");
    exit;
}

$nombre_usuario = $_SESSION['nombreUsu'];

// Verificar conexión
if (!isset($conexion)) {
    die("No se estableció conexión con la base de datos.");
}

// Obtener ID del usuario desde su username
$stmt = $conexion->prepare("SELECT id_usuario FROM usuarios WHERE username = ?");
$stmt->bind_param("s", $nombre_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

if (!$usuario) {
    die("No se encontró al usuario en la base de datos.");
}

$id_usuario = $usuario['id_usuario'];
$cesta = $_SESSION['cesta'] ?? [];

if (empty($cesta)) {
    die("Tu cesta está vacía.");
}

// Iniciar transacción
$conexion->begin_transaction();

try {
    foreach ($cesta as $id_producto => $cantidad) {
        $stmt = $conexion->prepare("SELECT stock, precio_compra FROM productos WHERE id_producto = ?");
        $stmt->bind_param("i", $id_producto);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $producto = $resultado->fetch_assoc();

        if (!$producto) {
            throw new Exception("Producto no encontrado.");
        }

        if ($producto['stock'] < $cantidad) {
            throw new Exception("Stock insuficiente para el producto con ID $id_producto.");
        }

        $total = $producto['precio_compra'] * $cantidad;

        // Insertar compra
        $stmt = $conexion->prepare("INSERT INTO compras (id_usuario, id_producto, cantidad, total) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $id_usuario, $id_producto, $cantidad, $total);
        $stmt->execute();

        // Actualizar stock
        $nuevo_stock = $producto['stock'] - $cantidad;
        $stmt = $conexion->prepare("UPDATE productos SET stock = ? WHERE id_producto = ?");
        $stmt->bind_param("ii", $nuevo_stock, $id_producto);
        $stmt->execute();
    }

    unset($_SESSION['cesta']);
    $conexion->commit();

    echo "<h2>¡Compra realizada con éxito!</h2>";
    echo "<p><a href='catalogo.php'>Volver al catálogo</a></p>";

} catch (Exception $e) {
    $conexion->rollback();
    echo "<h2>Error en la compra:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p><a href='ver_cesta.php'>Volver a la cesta</a></p>";
}
?>
