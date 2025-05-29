<?php
session_start();
require_once '../../login.php'; // contiene $hn, $db, $un, $pw

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM productos WHERE tipo = 'película'";
$result = $conn->query($sql);

$rol = $_SESSION['rol'] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Películas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap y Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        .card:hover {
            transform: scale(1.02);
            transition: transform 0.2s;
        }
        .card-img-top {
            object-fit: cover;
            height: 300px;
        }
    </style>
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="../../index.php">Level Up Video</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="../../index.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link active" href="catalogo_peliculas.php">Películas</a></li>
                <li class="nav-item"><a class="nav-link" href="../../Catalogos/CatalogoVideojuego/catalogo_videojuegos.php">Juegos</a></li>
                <li class="nav-item"><a class="nav-link" href="../../AlquileresActivos/alquileres_activos.php">Alquileres Activos</a></li>
                <li><a href="../../Carrito/ver_cesta.php" class="btn btn-outline-primary">🛒 Cesta (<?= count($_SESSION['cesta'] ?? []) ?>)</a></li>
                <li><a href="../../CarritoAlquiler/ver_cesta_alquiler.php" class="btn btn-outline-primary">🛒 Cesta Alquiler (<?= count($_SESSION['cesta_alquiler'] ?? []) ?>)</a></li>

                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador'): ?>
                    <!-- Desplegable para administrador -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-success text-white mx-2" href="#" id="adminMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Gestión
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../../Administrador/SeleccionProductoInsertar.php">Añadir Productos</a></li>
                            <li><a class="dropdown-item" href="../../Administrador/Publicaciones/nueva_publicacion.php">Añadir Publicaciones</a></li>
                            <li><a class="dropdown-item" href="../../Administrador/estadisticas.php">Estadísticas</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['nombreUsu'])): ?>
                    <li class="nav-item me-2 d-flex align-items-center text-white">
                        Bienvenido, <?= htmlspecialchars($_SESSION['nombreUsu']) ?>
                    </li>
                    <li class="nav-item"><a class="nav-link btn btn-danger text-white" href="../../logout.php">Cerrar sesión</a></li>
                <?php else: ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="../../FormularioLoginRegistro/Logeo/login.php">Iniciar sesión</a></li>
                            <li><a class="dropdown-item" href="../../FormularioLoginRegistro/Registro/registro.php">Registrarse</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>


<!-- Contenido -->
<div class="container my-5">
    <h1 class="mb-4 text-center">Catálogo de Películas</h1>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <a href="../detalle_producto.php?id=<?= $row['id_producto'] ?>" class="text-decoration-none text-dark">
                        <?php if (!empty($row['imagen'])): ?>
                            <img src="/ProyectoFinalDAW/Administrador/Formularios_Insert_Productos/Peliculas/<?= htmlspecialchars($row['imagen']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['titulo']) ?>">
                        <?php else: ?>
                            <div class="card-img-top bg-secondary text-white text-center d-flex align-items-center justify-content-center" style="height: 300px;">
                                Sin imagen
                            </div>
                        <?php endif; ?>

                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['titulo']) ?></h5>
                            <p class="card-text">
                                <strong>Precio de compra:</strong> €<?= number_format($row['precio_compra'], 2) ?><br>
                                <strong>Precio de alquiler:</strong> €<?= number_format($row['precio_alquiler'], 2) ?>
                            </p>
                        </div>
                    </a>

                    <?php if ($rol === 'administrador'): ?>
                        <div class="card-footer d-flex justify-content-between">
                            <form action="../../Administrador/Admin_Catalogo/EditarProductos/editar_producto.php" method="get">
                                <input type="hidden" name="id" value="<?= $row['id_producto'] ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Editar</button>
                            </form>
                            <form action="../../Administrador/Admin_Catalogo/BorrarProductos/borrar_producto.php" method="post" onsubmit="return confirm('¿Estás seguro de borrar esta película?');">
                                <input type="hidden" name="id" value="<?= $row['id_producto'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
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
