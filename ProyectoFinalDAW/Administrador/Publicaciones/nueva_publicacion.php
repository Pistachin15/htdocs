<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'administrador') {
    header('Location: ../../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../../login.php';

    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $autor = $_SESSION['username']; // suponiendo que guardas el nombre de usuario en sesión

    $stmt = $conn->prepare("INSERT INTO publicaciones (titulo, contenido, autor) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $titulo, $contenido, $autor);
    $stmt->execute();

    header("Location: ../../index.php?mensaje=publicado");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Publicación</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../styles.css">
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

                <li class="nav-item"><a class="nav-link" href="../../index.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="../../Catalogos/CatalogoPelicula/catalogo_peliculas.php">Películas</a></li>
                <li class="nav-item"><a class="nav-link" href="../../Catalogos/CatalogoVideojuego/catalogo_videojuegos.php">Juegos</a></li>
                <li class="nav-item"><a class="nav-link" href="../../AlquileresActivos/alquileres_activos.php">Alquileres Activos</a></li>

                <li><a href="../../Carrito/ver_cesta.php" class="btn btn-outline-primary me-2">🛒 Cesta (<?= count($_SESSION['cesta'] ?? []) ?>)</a></li>
                <li><a href="../../CarritoAlquiler/ver_cesta_alquiler.php" class="btn btn-outline-primary">🎞 Cesta Alquiler (<?= count($_SESSION['cesta_alquiler'] ?? []) ?>)</a></li>

                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador'): ?>
                    <!-- Menú desplegable para administrador -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-success text-white mx-2" href="#" id="adminMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Gestión
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../../Administrador/SeleccionProductoInsertar.php">Añadir Productos</a></li>
                            <li><a class="dropdown-item" href="../estadisticas.php">Estadísticas</a></li>
                            <li><a class="dropdown-item" href="#">Añadir Publicaciones</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="nav-item me-2 d-flex align-items-center text-white">
                    Bienvenido, <?= htmlspecialchars($_SESSION['nombreUsu']) ?>
                </li>
                <li class="nav-item"><a class="nav-link btn btn-danger text-white" href="../../logout.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </div>
</nav>

    <!-- Formulario publicación -->
    <div class="container">
        <h2 class="mb-4 text-center">Crear nueva publicación</h2>
        <form method="POST" class="mx-auto" style="max-width: 700px;">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="contenido" class="form-label">Contenido</label>
                <textarea name="contenido" class="form-control" rows="6" required></textarea>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Publicar</button>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 Videoclub Online. Todos los derechos reservados.</p>
            <div class="mt-2">
                <a href="#" class="text-white mx-2"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white mx-2"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-white mx-2"><i class="bi bi-instagram"></i></a>
            </div>
        </div>
    </footer>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
