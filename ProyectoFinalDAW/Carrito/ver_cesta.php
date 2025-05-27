<?php
session_start();

// ✅ Protección: redirigir al login si no ha iniciado sesión
if (!isset($_SESSION['nombreUsu'])) {
    header("Location: ../FormularioLoginRegistro/Logeo/login.php?mensaje=cesta");
    exit;
}

$cesta = $_SESSION['cesta'] ?? [];
$origen = $_SESSION['origen_catalogo'] ?? '../Catalogos/CatalogoVideojuego/catalogo_videojuegos.php';
var_dump($origen);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tu Cesta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">🛒 Tu Cesta</h2>

    <?php if (empty($cesta)): ?>
        <div class="alert alert-info">No has añadido productos todavía.</div>
        <a href="../Index.php" class="btn btn-primary">Volver al Inicio</a>
    <?php else: ?>
        <table class="table table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Título</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($cesta as $id => $item):
                    $subtotal = $item['precio'] * $item['cantidad'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($item['titulo']) ?></td>
                        <td>€<?= number_format($item['precio'], 2) ?></td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <a href="actualizar_cantidad.php?id=<?= $id ?>&accion=restar" class="btn btn-sm btn-outline-secondary">−</a>
                                <?= $item['cantidad'] ?>
                                <a href="actualizar_cantidad.php?id=<?= $id ?>&accion=sumar" class="btn btn-sm btn-outline-secondary">+</a>
                            </div>
                        </td>
                        <td>€<?= number_format($subtotal, 2) ?></td>
                        <td>
                            <a href="eliminar_de_cesta.php?id=<?= $id ?>" class="btn btn-sm btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr class="table-secondary">
                    <td colspan="3"><strong>Total</strong></td>
                    <td><strong>€<?= number_format($total, 2) ?></strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between">
            <a href="<?= htmlspecialchars($origen) ?>" class="btn btn-secondary">← Seguir comprando</a>
            <a href="vaciar_cesta.php" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas vaciar la cesta?');">Vaciar Cesta</a>
        </div>
        <form action="procesar_compra.php" method="post">
            <button type="submit">Comprar ahora</button>
        </form>

    <?php endif; ?>
</div>
</body>
</html>
