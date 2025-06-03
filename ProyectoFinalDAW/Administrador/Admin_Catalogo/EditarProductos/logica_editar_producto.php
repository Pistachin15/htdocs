<?php
require_once '../../../login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Conexión fallida.");
}

function mostrarError($mensaje) {
    echo "<div class='alert alert-danger'>$mensaje</div><a href='javascript:history.back()'>Volver</a>";
    exit();
}

$id = intval($_POST['id_producto']);
$titulo = trim($_POST['titulo']);
$descripcion = trim($_POST['descripcion']);
$stock = intval($_POST['stock']);
$precio_compra = floatval($_POST['precio_compra']);
$precio_alquiler = floatval($_POST['precio_alquiler']);
$tipo = $_POST['tipo'];

if (empty($titulo) || empty($descripcion) || $stock < 0 || $precio_compra < 0 || $precio_alquiler < 0) {
    mostrarError("Datos inválidos.");
}

$stmt = $conn->prepare("SELECT id_producto FROM productos WHERE titulo = ? AND tipo = ? AND id_producto != ?");
$stmt->bind_param("ssi", $titulo, $tipo, $id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    mostrarError("Ya existe otro producto con ese título.");
}
$stmt->close();

$stmt = $conn->prepare("UPDATE productos SET titulo=?, descripcion=?, stock=?, precio_compra=?, precio_alquiler=? WHERE id_producto=?");
$stmt->bind_param("ssiddi", $titulo, $descripcion, $stock, $precio_compra, $precio_alquiler, $id);

if ($stmt->execute()) {
    if ($tipo === 'videojuego') {
        header("Location: ../../../Catalogos/CatalogoVideojuego/catalogo_videojuegos.php");
    } elseif ($tipo === 'película') {
        header("Location: ../../../Catalogos/CatalogoPelicula/catalogo_peliculas.php");
    }
} else {
    mostrarError("Error al actualizar el producto.");
}

$stmt->close();
$conn->close();
