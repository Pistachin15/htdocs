<?php
session_start();
require_once '../../../login.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    die("Acceso denegado.");
}

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    die("ID de producto inválido.");
}

$sql = "SELECT * FROM productos WHERE id_producto = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Producto no encontrado.");
}

$producto = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar <?= htmlspecialchars($producto['tipo']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .stock-controls button { min-width: 2.5rem; }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2>Editar <?= htmlspecialchars($producto['tipo']) ?></h2>

    <form action="logica_editar_producto.php" method="post" enctype="multipart/form-data" class="row g-3">
        <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">
        <input type="hidden" name="tipo" value="<?= htmlspecialchars($producto['tipo']) ?>">

        <div class="col-md-6">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" name="titulo" id="titulo" required value="<?= htmlspecialchars($producto['titulo']) ?>">
        </div>

        <div class="col-md-12">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required><?= htmlspecialchars($producto['descripcion']) ?></textarea>
        </div>

        <div class="col-md-4">
            <label for="stock" class="form-label">Stock</label>
            <div class="input-group stock-controls">
                <button type="button" class="btn btn-outline-secondary" onclick="cambiarStock(-1)">-</button>
                <input type="number" class="form-control text-center" name="stock" id="stock" value="<?= $producto['stock'] ?>" min="0" required>
                <button type="button" class="btn btn-outline-secondary" onclick="cambiarStock(1)">+</button>
            </div>
        </div>

        <div class="col-md-4">
            <label for="precio_compra" class="form-label">Precio de Compra</label>
            <input type="number" class="form-control" name="precio_compra" step="0.01" min="0" required value="<?= $producto['precio_compra'] ?>">
        </div>

        <div class="col-md-4">
            <label for="precio_alquiler" class="form-label">Precio de Alquiler</label>
            <input type="number" class="form-control" name="precio_alquiler" step="0.01" min="0" required value="<?= $producto['precio_alquiler'] ?>">
        </div>

        <div class="col-md-6">
            <label for="imagen" class="form-label">Imagen (opcional)</label>
            <input type="file" class="form-control" name="imagen" accept="image/*">
            <?php if (!empty($producto['imagen'])): ?>
                <p class="mt-2">Imagen actual: <img src="/ProyectoFinalDAW/Administrador/Formularios_Insert_Productos/<?= ucfirst($producto['tipo']) ?>s/<?= htmlspecialchars($producto['imagen']) ?>" width="100" alt="Imagen actual"></p>
            <?php endif; ?>
        </div>

        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
    </form>
</div>

<script>
    function cambiarStock(valor) {
        const stockInput = document.getElementById('stock');
        let actual = parseInt(stockInput.value) || 0;
        actual = Math.max(0, actual + valor);
        stockInput.value = actual;
    }
</script>

</body>
</html>
