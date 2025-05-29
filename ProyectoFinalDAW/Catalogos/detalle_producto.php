<?php
session_start();
require_once '../login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

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

$imagen_mostrada = "imagenes/default.jpg";
if (!empty($producto['imagen'])) {
    $ruta = $producto['tipo'] === 'película' ? "Peliculas" : "Videojuegos";
    $imagen_mostrada = "Administrador/Formularios_Insert_Productos/$ruta/" . $producto['imagen'];
}

$sin_stock = ($producto['stock'] <= 0);
$rol = $_SESSION['rol'] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($producto['titulo']) ?> - Detalle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap y Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        .producto-detalle {
            max-width: 1000px;
            margin: 50px auto;
        }
        .producto-detalle img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
        }
        .btns-acciones button, .btns-acciones a {
            margin-right: 10px;
        }
    </style>
</head>
<body class="bg-light">

<!-- Navbar -->
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
                <li class="nav-item"><a class="nav-link active" href="CatalogoVideojuego/catalogo_videojuegos.php">Juegos</a></li>
                <li class="nav-item"><a class="nav-link" href="../AlquileresActivos/alquileres_activos.php">Alquileres Activos</a></li>
                <li><a href="../Carrito/ver_cesta.php" class="btn btn-outline-primary">🛒 Cesta (<?= count($_SESSION['cesta'] ?? []) ?>)</a></li>
                <li><a href="../CarritoAlquiler/ver_cesta_alquiler.php" class="btn btn-outline-primary">🛒 Cesta Alquiler (<?= count($_SESSION['cesta_alquiler'] ?? []) ?>)</a></li>

                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador'): ?>
                    <!-- Desplegable de administrador -->
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

                <?php if (isset($_SESSION['nombreUsu'])): ?>
                    <li class="nav-item me-2 d-flex align-items-center text-white">
                        Bienvenido, <?= htmlspecialchars($_SESSION['nombreUsu']) ?>
                    </li>
                    <li class="nav-item"><a class="nav-link btn btn-danger text-white" href="../logout.php">Cerrar sesión</a></li>
                <?php else: ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="../FormularioLoginRegistro/Logeo/login.php">Iniciar sesión</a></li>
                            <li><a class="dropdown-item" href="../FormularioLoginRegistro/Registro/registro.php">Registrarse</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Detalle del producto -->
<div class="container producto-detalle bg-white shadow-sm p-4 rounded">
    <h2 class="mb-4"><?= htmlspecialchars($producto['titulo']) ?></h2>
    <div class="row">
        <div class="col-md-5">
            <img src="/ProyectoFinalDAW/<?= htmlspecialchars($imagen_mostrada) ?>" alt="<?= htmlspecialchars($producto['titulo']) ?>">
        </div>
        <div class="col-md-7">
            <p><strong>Tipo:</strong> <?= ucfirst($producto['tipo']) ?></p>
            <p><strong>Descripción:</strong><br><?= nl2br(htmlspecialchars($producto['descripcion'])) ?></p>
            <p><strong>Stock disponible:</strong> <?= $producto['stock'] ?></p>
            <p><strong>Precio de compra:</strong> €<?= number_format($producto['precio_compra'], 2) ?></p>
            <p><strong>Precio de alquiler:</strong> €<?= number_format($producto['precio_alquiler'], 2) ?></p>

            <?php if ($sin_stock): ?>
                <div class="alert alert-warning mt-3">Actualmente no hay disponibilidad. Espera al reabastecimiento.</div>
            <?php endif; ?>

            <div class="btns-acciones mt-4">
                <?php if (isset($_SESSION['nombreUsu'])): ?>
                    <form action="../Carrito/añadir_a_cesta.php" method="get" class="d-inline">
                        <input type="hidden" name="id" value="<?= $producto['id_producto'] ?>">
                        <button type="submit" class="btn btn-success" <?= $sin_stock ? 'disabled' : '' ?>>
                            <i class="bi bi-cart-plus"></i> Añadir a la cesta
                        </button>
                    </form>

                    <form action="../CarritoAlquiler/añadir_a_alquiler.php" method="get" class="d-inline">
                        <input type="hidden" name="id" value="<?= $producto['id_producto'] ?>">
                        <button type="submit" class="btn btn-warning" <?= $sin_stock ? 'disabled' : '' ?>>
                            <i class="bi bi-camera-reels"></i> Alquilar
                        </button>
                    </form>
                <?php else: ?>
                    <a href="../FormularioLoginRegistro/Logeo/login.php" class="btn btn-outline-success me-2">Inicia sesión para comprar</a>
                    <a href="../FormularioLoginRegistro/Logeo/login.php" class="btn btn-outline-warning">Inicia sesión para alquilar</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
        <p class="mb-0">&copy; 2023 Videoclub Online. Todos los derechos reservados.</p>
        <div class="mt-2">
            <a href="#" class="text-white mx-2"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-white mx-2"><i class="bi bi-twitter"></i></a>
            <a href="#" class="text-white mx-2"><i class="bi bi-instagram"></i></a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
