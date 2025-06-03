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
        html, body {
            height: 100%;
            background-color: #f8f9fa;
        }
        .center-container {
            min-height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .edit-form {
            width: 100%;
            max-width: 700px;
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0 1rem rgba(0,0,0,0.1);
        }
        .stock-controls button {
            min-width: 2.5rem;
        }
    </style>
</head>
<body>

<div class="container center-container">
    <div class="edit-form">
        <h3 class="text-center mb-4">Editar <?= htmlspecialchars($producto['tipo']) ?></h3>

        <form action="logica_editar_producto.php" method="post" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
            <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">
            <input type="hidden" name="tipo" value="<?= htmlspecialchars($producto['tipo']) ?>">

            <div class="col-md-12">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" name="titulo" id="titulo" required value="<?= htmlspecialchars($producto['titulo']) ?>">
                <div class="invalid-feedback">Este campo es obligatorio.</div>
            </div>

            <div class="col-md-12">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required><?= htmlspecialchars($producto['descripcion']) ?></textarea>
                <div class="invalid-feedback">Este campo es obligatorio.</div>
            </div>

            <div class="col-md-4">
                <label for="stock" class="form-label">Stock</label>
                <div class="input-group stock-controls">
                    <button type="button" class="btn btn-outline-secondary" onclick="cambiarStock(-1)">-</button>
                    <input type="number" class="form-control text-center" name="stock" id="stock" value="<?= $producto['stock'] ?>" min="0" required>
                    <button type="button" class="btn btn-outline-secondary" onclick="cambiarStock(1)">+</button>
                    <div class="invalid-feedback">Debe ser un número mayor o igual a 0.</div>
                </div>
            </div>

            <div class="col-md-4">
                <label for="precio_compra" class="form-label">Precio de Compra</label>
                <input type="number" class="form-control" name="precio_compra" step="0.01" min="0" required value="<?= $producto['precio_compra'] ?>">
                <div class="invalid-feedback">Introduce un precio válido.</div>
            </div>

            <div class="col-md-4">
                <label for="precio_alquiler" class="form-label">Precio de Alquiler</label>
                <input type="number" class="form-control" name="precio_alquiler" step="0.01" min="0" required value="<?= $producto['precio_alquiler'] ?>">
                <div class="invalid-feedback">Introduce un precio válido.</div>
            </div>

            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>

<script>
    function cambiarStock(valor) {
        const stockInput = document.getElementById('stock');
        let actual = parseInt(stockInput.value) || 0;
        actual = Math.max(0, actual + valor);
        stockInput.value = actual;
    }

    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>

</body>
</html>
