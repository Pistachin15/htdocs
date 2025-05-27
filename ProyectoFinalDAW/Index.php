<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videoclub Online - Películas y Juegos</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados (opcional) -->
    <link rel="stylesheet" href="styles.css">
    <!-- Iconos de Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
    <!-- Header / Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Videoclub Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Catalogos/CatalogoPelicula/catalogo_peliculas.php">Películas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Catalogos/CatalogoVideojuego/catalogo_videojuegos.php">Juegos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="AlquileresActivos/alquileres_activos.php">Alquileres Activos</a>
                    </li>
                    <li>
                        <a href="Carrito/ver_cesta.php" class="btn btn-outline-primary">🛒 Cesta (<?= count($_SESSION['cesta'] ?? []) ?>)</a>
                    </li>

                    <li>
                        <a href="CarritoAlquiler/ver_cesta_alquiler.php" class="btn btn-outline-primary">🛒 Cesta Alquiler (<?= count($_SESSION['cesta_alquiler'] ?? []) ?>)</a>
                    </li>
                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador'): ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-success text-white mx-2" href="Administrador/SeleccionProductoInsertar.php">Añadir Productos</a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador'): ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-success text-white mx-2" href="estadisticas.php">Estadísticas</a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['nombreUsu'])): ?>
                        <li class="nav-item me-2 d-flex align-items-center text-white">
                            Bienvenido, <?php echo htmlspecialchars($_SESSION['nombreUsu']); ?>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-danger text-white" href="logout.php">Cerrar sesión</a>
                        </li>
                    <?php else: ?>
                        <!-- Menú desplegable de usuario -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
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
        <div class="alert alert-info">
            Próximamente: Catálogo de películas y juegos disponibles.
        </div>
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

    <!-- Bootstrap 5 JS (Popper y Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
