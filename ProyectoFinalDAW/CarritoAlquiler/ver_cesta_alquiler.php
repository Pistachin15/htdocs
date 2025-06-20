<?php
session_start();

if (!isset($_SESSION['nombreUsu'])) {
    header("Location: ../FormularioLoginRegistro/Logeo/login.php?mensaje=cesta");
    exit;
}

$cesta_alquiler = $_SESSION['cesta_alquiler'] ?? [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cesta de Alquiler</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
        }
        .cesta-container {
            max-width: 900px;
            margin: 40px auto;
            flex: 1 0 auto; 
            background-color: white;
            padding: 1.5rem;
            border-radius: 0.375rem; 
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        footer {
            flex-shrink: 0; 
            background-color: #212529; 
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: auto;
            width: 100%;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="../index.php">Level Up Video</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item"><a class="nav-link" href="../index.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="../Catalogos/CatalogoPelicula/catalogo_peliculas.php">Películas</a></li>
                <li class="nav-item"><a class="nav-link" href="../Catalogos/CatalogoVideojuego/catalogo_videojuegos.php">Juegos</a></li>
                <li class="nav-item"><a class="nav-link" href="../AlquileresActivos/alquileres_activos.php">Alquileres Activos</a></li>

                <li><a href="../Carrito/ver_cesta.php" class="btn btn-outline-primary me-2">🛒 Cesta (<?= count($_SESSION['cesta'] ?? []) ?>)</a></li>
                <li><a href="ver_cesta_alquiler.php" class="btn btn-outline-primary">🎞 Cesta Alquiler (<?= count($_SESSION['cesta_alquiler'] ?? []) ?>)</a></li>

                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador'): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-success text-white mx-2" href="#" id="adminMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Gestión
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../Administrador/SeleccionProductoInsertar.php">Añadir Productos</a></li>
                            <li><a class="dropdown-item" href="../Administrador/Publicaciones/nueva_publicacion.php">Añadir Publicaciones</a></li>
                            <li><a class="dropdown-item" href="../Administrador/estadisticas.php">Estadísticas</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="nav-item me-2 d-flex align-items-center text-white">
                    Bienvenido, <?= htmlspecialchars($_SESSION['nombreUsu']) ?>
                </li>
                <li class="nav-item"><a class="nav-link btn btn-danger text-white" href="../logout.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container cesta-container">
    <h2 class="mb-4">🎬 Tu Cesta de Alquiler</h2>

    <?php if (empty($cesta_alquiler)): ?>
        <div class="alert alert-info">No has añadido productos a alquilar todavía.</div>
        <a href="../Index.php" class="btn btn-primary">Volver al Inicio</a>
    <?php else: ?>
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Título</th>
                    <th>Precio Alquiler</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($cesta_alquiler as $id => $item):
                    $subtotal = $item['precio'] * $item['cantidad'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($item['titulo']) ?></td>
                        <td>€<?= number_format($item['precio'], 2) ?></td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <a href="actualizar_cantidad_alquiler.php?id=<?= $id ?>&accion=restar" class="btn btn-sm btn-outline-secondary">−</a>
                                <span><?= $item['cantidad'] ?></span>
                                <a href="actualizar_cantidad_alquiler.php?id=<?= $id ?>&accion=sumar" class="btn btn-sm btn-outline-secondary">+</a>
                            </div>
                        </td>
                        <td>€<?= number_format($subtotal, 2) ?></td>
                        <td>
                            <a href="eliminar_de_cesta_alquiler.php?id=<?= $id ?>" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i> Eliminar
                            </a>
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

        <div class="d-flex justify-content-between mt-3">
            <a href="vaciar_cesta_alquiler.php" class="btn btn-danger" onclick="return confirm('¿Vaciar la cesta de alquileres?');">
                <i class="bi bi-trash3"></i> Vaciar Cesta
            </a>
        </div>

        <div class="text-end mt-4">
            <a href="../FormularioPago/formulario_pago.php?tipo=alquiler" class="btn btn-success btn-lg">
                <i class="bi bi-credit-card"></i> Finalizar Alquiler
            </a>
        </div>
    <?php endif; ?>
</div>

<footer>
    <div class="container">
        &copy; 2025 Level Up Video. Todos los derechos reservados.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
