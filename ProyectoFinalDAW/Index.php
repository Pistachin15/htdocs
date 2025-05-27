<?php
session_start();
require_once "login.php"; // Asegúrate de tener este archivo con tu conexión a la BD

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta productos con imagen (máximo 5 aleatorios)
$sql = "SELECT id_producto, titulo, imagen, tipo FROM productos WHERE imagen IS NOT NULL AND imagen != '' ORDER BY RAND() LIMIT 5";
$resultado = $conn->query($sql);
$productos = $resultado->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videoclub Online - Películas y Juegos</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Videoclub Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="Catalogos/CatalogoPelicula/catalogo_peliculas.php">Películas</a></li>
                    <li class="nav-item"><a class="nav-link" href="Catalogos/CatalogoVideojuego/catalogo_videojuegos.php">Juegos</a></li>
                    <li class="nav-item"><a class="nav-link" href="AlquileresActivos/alquileres_activos.php">Alquileres Activos</a></li>
                    <li><a href="Carrito/ver_cesta.php" class="btn btn-outline-primary">🛒 Cesta (<?= count($_SESSION['cesta'] ?? []) ?>)</a></li>
                    <li><a href="CarritoAlquiler/ver_cesta_alquiler.php" class="btn btn-outline-primary">🛒 Cesta Alquiler (<?= count($_SESSION['cesta_alquiler'] ?? []) ?>)</a></li>
                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador'): ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-success text-white mx-2" href="Administrador/SeleccionProductoInsertar.php">Añadir Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-success text-white mx-2" href="estadisticas.php">Estadísticas</a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['nombreUsu'])): ?>
                        <li class="nav-item me-2 d-flex align-items-center text-white">
                            Bienvenido, <?= htmlspecialchars($_SESSION['nombreUsu']); ?>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-danger text-white" href="logout.php">Cerrar sesión</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="FormularioLoginRegistro/Logeo/login.php">Iniciar sesión</a></li>
                                <li><a class="dropdown-item" href="FormularioLoginRegistro/Registro/registro.php">Registrarse</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="container my-5">
        <h1 class="text-center mb-4">Bienvenido al Videoclub Online</h1>

        <?php if (!empty($productos)): ?>
            <div id="carouselProductos" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($productos as $index => $producto): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <img src="/ProyectoFinalDAW/Administrador/Formularios_Insert_Productos/<?= $producto['tipo'] === 'videojuego' ? 'Videojuegos' : 'Peliculas' ?>/<?= htmlspecialchars($producto['imagen']) ?>" class="d-block w-100" alt="<?= htmlspecialchars($producto['titulo']) ?>" style="max-height: 500px; object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                                <h5><?= htmlspecialchars($producto['titulo']) ?></h5>
                                <p><?= ucfirst($producto['tipo']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselProductos" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselProductos" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        <?php else: ?>
            <div class="alert alert-info">No hay productos con imagen para mostrar.</div>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 Videoclub Online. Todos los derechos reservados.</p>
            <div class="mt-2">
                <a href="#" class="text-white mx-2"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white mx-2"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-white mx-2"><i class="bi bi-instagram"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
