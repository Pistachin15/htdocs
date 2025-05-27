<?php
session_start();
require_once '../login.php'; // Ajusta si el archivo está en otra ruta

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Validar el parámetro ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID de producto inválido.";
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM productos WHERE id_producto = $id";
$resultado = $conn->query($sql);

if (!$resultado || $resultado->num_rows === 0) {
    echo "Producto no encontrado.";
    exit;
}

$producto = $resultado->fetch_assoc();

// Determinar la imagen (ruta relativa al proyecto)
$imagen_mostrada = "imagenes/default.jpg"; // Por defecto

if (!empty($producto['imagen'])) {
    if ($producto['tipo'] === 'película') {
        $imagen_mostrada = "Administrador/Formularios_Insert_Productos/Peliculas/" . $producto['imagen'];
    } elseif ($producto['tipo'] === 'videojuego') {
        $imagen_mostrada = "Administrador/Formularios_Insert_Productos/Videojuegos/" . $producto['imagen'];
    }
}

// Verificar si hay stock
$sin_stock = ($producto['stock'] <= 0);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle - <?= htmlspecialchars($producto['titulo']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .detalle {
            max-width: 800px;
            margin: 30px auto;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
        }
        .detalle img {
            max-width: 100%;
            height: auto;
        }
        .mensaje-stock {
            color: red;
            font-weight: bold;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="container detalle">
    <h2><?= htmlspecialchars($producto['titulo']) ?></h2>
    <div class="row">
        <div class="col-md-4">
            <img src="/ProyectoFinalDAW/<?= htmlspecialchars($imagen_mostrada) ?>" alt="<?= htmlspecialchars($producto['titulo']) ?>" class="img-fluid rounded">
        </div>
        <div class="col-md-8">
            <p><strong>Tipo:</strong> <?= ucfirst($producto['tipo']) ?></p>
            <p><strong>Descripción:</strong><br><?= nl2br(htmlspecialchars($producto['descripcion'])) ?></p>
            <p><strong>Stock disponible:</strong> <?= $producto['stock'] ?></p>
            <p><strong>Precio de compra:</strong> €<?= number_format($producto['precio_compra'], 2) ?></p>
            <p><strong>Precio de alquiler:</strong> €<?= number_format($producto['precio_alquiler'], 2) ?></p>

            <?php if ($sin_stock): ?>
                <p class="mensaje-stock">Actualmente no hay disponibilidad, esperé al reabastecimiento.</p>
            <?php endif; ?>

            <div class="mt-4">
                <?php if (isset($_SESSION['nombreUsu'])): ?>
                    <form action="../Carrito/añadir_a_cesta.php" method="get" class="d-inline">
                        <input type="hidden" name="id" value="<?= $producto['id_producto'] ?>">
                        <button type="submit" class="btn btn-success me-2" <?= $sin_stock ? 'disabled' : '' ?>>Añadir a la cesta</button>
                    </form>
                <?php else: ?>
                    <a href="../FormularioLoginRegistro/Logeo/login.php" class="btn btn-outline-success me-2">Inicia sesión para comprar</a>
                <?php endif; ?>

                <?php if (isset($_SESSION['nombreUsu'])): ?>
                <form action="../CarritoAlquiler/añadir_a_alquiler.php" method="get" class="d-inline">
                    <input type="hidden" name="id" value="<?= $producto['id_producto'] ?>">
                    <button type="submit" class="btn btn-warning" <?= $sin_stock ? 'disabled' : '' ?>>Alquilar</button>
                </form>
            <?php else: ?>
                <a href="../FormularioLoginRegistro/Logeo/login.php" class="btn btn-outline-warning">Inicia sesión para alquilar</a>
            <?php endif; ?>

            </div>
        </div>
    </div>
</div>

</body>
</html>
