<?php
session_start();
require_once "login.php"; 
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT id_producto, titulo, imagen, tipo FROM productos WHERE imagen IS NOT NULL AND imagen != '' ORDER BY RAND() LIMIT 5";
$resultado = $conn->query($sql);
$productos = $resultado->fetch_all(MYSQLI_ASSOC);

$publicaciones = $conn->query("SELECT id_publicacion, titulo, contenido, autor, fecha_publicacion FROM publicaciones ORDER BY fecha_publicacion DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Videoclub Online - Películas y Juegos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css" />
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css"
    />
    <style>
    html, body {
        height: 100%;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
    }

    #carouselProductos {
        max-width: 100%;
    }

    #carouselProductos .carousel-inner,
    #carouselProductos .carousel-item {
        height: 500px;
    }

    #carouselProductos img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    @media (max-width: 767.98px) {
        #carouselProductos .carousel-inner,
        #carouselProductos .carousel-item {
            height: 250px;
        }
    }

    @media (min-width: 768px) and (max-width: 991.98px) {
        #carouselProductos .carousel-inner,
        #carouselProductos .carousel-item {
            height: 350px;
        }
    }

    .sidebar-publicaciones {
        margin-top: 2rem;
    }

    @media (max-width: 575.98px) {
        .navbar-nav .btn {
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            width: 100%;
            text-align: center;
        }
        .navbar-nav .nav-item {
            width: 100%;
        }
    }
</style>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Navegación principal">
        <div class="container">
            <a class="navbar-brand" href="index.php">Level Up Video</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Alternar navegación"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="Catalogos/CatalogoPelicula/catalogo_peliculas.php">Películas</a></li>
                    <li class="nav-item"><a class="nav-link" href="Catalogos/CatalogoVideojuego/catalogo_videojuegos.php">Juegos</a></li>
                    <li class="nav-item"><a class="nav-link" href="AlquileresActivos/alquileres_activos.php">Alquileres Activos</a></li>
                    <li class="nav-item">
                        <a href="Carrito/ver_cesta.php" class="btn btn-outline-primary mx-1">🛒 Cesta (<?= count($_SESSION['cesta'] ?? []) ?>)</a>
                    </li>
                    <li class="nav-item">
                        <a href="CarritoAlquiler/ver_cesta_alquiler.php" class="btn btn-outline-primary mx-1">🎞 Cesta Alquiler (<?= count($_SESSION['cesta_alquiler'] ?? []) ?>)</a>
                    </li>

                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador'): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle btn btn-success text-white mx-2" href="#" id="adminMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Gestión
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="Administrador/SeleccionProductoInsertar.php">Añadir Productos</a></li>
                                <li><a class="dropdown-item" href="Administrador/Publicaciones/nueva_publicacion.php">Añadir Publicaciones</a></li>
                                <li><a class="dropdown-item" href="Administrador/estadisticas.php">Estadísticas</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['nombreUsu'])): ?>
                        <li class="nav-item me-2 d-flex align-items-center text-white">
                            Bienvenid@, <?= htmlspecialchars($_SESSION['nombreUsu']); ?>
                        </li>
                        <li class="nav-item"><a class="nav-link btn btn-danger text-white" href="logout.php">Cerrar sesión</a></li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle"></i></a>
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

    <main class="container my-5">
        <div class="row">
            <!-- Contenido principal -->
            <div class="col-12 col-md-8">
                <h1 class="text-center mb-4">Bienvenido a Level Up Video</h1>
                <?php if (!empty($productos)): ?>
                    <div id="carouselProductos" class="carousel slide mb-4" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($productos as $index => $producto): ?>
                                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                    <img
                                        src="/ProyectoFinalDAW/Administrador/Formularios_Insert_Productos/<?= $producto['tipo'] === 'videojuego' ? 'Videojuegos' : 'Peliculas' ?>/<?= htmlspecialchars($producto['imagen']) ?>"
                                        class="d-block w-100"
                                        alt="<?= htmlspecialchars($producto['titulo']) ?>"
                                    />
                                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                                        <h5><?= htmlspecialchars($producto['titulo']) ?></h5>
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
            </div>

            <!-- Sidebar publicaciones -->
            <div class="col-12 col-md-4 sidebar-publicaciones">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Publicaciones</h4>
                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador'): ?>
                        <a href="Administrador/Publicaciones/nueva_publicacion.php" class="btn btn-sm btn-success">+ Nueva</a>
                    <?php endif; ?>
                </div>

                <?php if ($publicaciones->num_rows > 0): ?>
                    <?php while ($pub = $publicaciones->fetch_assoc()): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($pub['titulo']) ?></h5>
                                <h6 class="card-subtitle text-muted mb-2"><?= htmlspecialchars($pub['autor']) ?> - <?= htmlspecialchars($pub['fecha_publicacion']) ?></h6>
                                <p class="card-text"><?= nl2br(htmlspecialchars($pub['contenido'])) ?></p>
                                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador'): ?>
                                    <form method="POST" action="Administrador/Publicaciones/eliminar_publicacion.php" onsubmit="return confirm('¿Estás seguro de eliminar esta publicación?');">
                                        <input type="hidden" name="id_publicacion" value="<?= $pub['id_publicacion'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm mt-2">Eliminar</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-muted">No hay publicaciones todavía.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 Level Up Video. Todos los derechos reservados.</p>
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
