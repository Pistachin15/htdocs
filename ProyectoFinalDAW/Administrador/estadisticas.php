<?php
session_start();

require_once '../login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificación de acceso solo para administradores
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: index.php");
    exit();
}

// Total de usuarios registrados
$result = $conn->query("SELECT COUNT(*) AS total FROM usuarios");
$totalUsuarios = $result->fetch_assoc()['total'];

// Usuarios compradores y alquiladores
$usuariosCompradores = $conn->query("SELECT COUNT(DISTINCT id_usuario) AS total FROM compras")->fetch_assoc()['total'];
$usuariosAlquiladores = $conn->query("SELECT COUNT(DISTINCT id_usuario) AS total FROM alquileres")->fetch_assoc()['total'];

// Compras por mes
$comprasPorMes = [];
$result = $conn->query("
    SELECT DATE_FORMAT(fecha_compra, '%Y-%m') AS mes, COUNT(*) AS total
    FROM compras
    GROUP BY mes
    ORDER BY mes DESC
    LIMIT 6
");
while ($row = $result->fetch_assoc()) {
    $comprasPorMes[] = $row;
}

$alquileresPorMes = [];
$result = $conn->query("
    SELECT DATE_FORMAT(fecha_alquiler, '%Y-%m') AS mes, COUNT(*) AS total
    FROM alquileres
    GROUP BY mes
    ORDER BY mes DESC
    LIMIT 6
");
while ($row = $result->fetch_assoc()) {
    $alquileresPorMes[] = $row;
}

$comprasMeses = array_reverse(array_column($comprasPorMes, 'mes'));
$comprasTotales = array_reverse(array_column($comprasPorMes, 'total'));
$alquileresMeses = array_reverse(array_column($alquileresPorMes, 'mes'));
$alquileresTotales = array_reverse(array_column($alquileresPorMes, 'total'));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadísticas del Videoclub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <li><a href="../CarritoAlquiler/ver_cesta_alquiler.php" class="btn btn-outline-primary">🎞 Cesta Alquiler (<?= count($_SESSION['cesta_alquiler'] ?? []) ?>)</a></li>

                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador'): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-success text-white mx-2" href="#" id="adminMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Gestión
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../Administrador/SeleccionProductoInsertar.php">Añadir Productos</a></li>
                            <li><a class="dropdown-item" href="estadisticas.php">Estadísticas</a></li>
                            <li><a class="dropdown-item" href="../Administrador/Publicaciones/nueva_publicacion.php">Añadir Publicaciones</a></li>
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

<main class="container my-5">
    <h1 class="text-center mb-4">📊 Estadísticas del Videoclub</h1>

    <div class="row text-center mb-4">
        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body">
                    <h5>Total de usuarios registrados</h5>
                    <h2><?= $totalUsuarios ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body">
                    <h5>Usuarios que han comprado</h5>
                    <h2><?= $usuariosCompradores ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body">
                    <h5>Usuarios que han alquilado</h5>
                    <h2><?= $usuariosAlquiladores ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-6">
            <h4 class="text-center">Compras por mes</h4>
            <canvas id="comprasChart"></canvas>
        </div>
        <div class="col-md-6">
            <h4 class="text-center">Alquileres por mes</h4>
            <canvas id="alquileresChart"></canvas>
        </div>
    </div>
</main>

<footer class="bg-dark text-white py-4">
    <div class="container text-center">
        <p class="mb-0">&copy; 2025 Level Up Video. Todos los derechos reservados.</p>
        <div class="mt-2">
            <a href="#" class="text-white mx-2"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-white mx-2"><i class="bi bi-twitter"></i></a>
            <a href="#" class="text-white mx-2"><i class="bi bi-instagram"></i></a>
        </div>
    </div>
</footer>

<script>
const comprasCtx = document.getElementById('comprasChart').getContext('2d');
new Chart(comprasCtx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($comprasMeses) ?>,
        datasets: [{
            label: 'Total de compras',
            data: <?= json_encode($comprasTotales) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.6)'
        }]
    }
});

const alquileresCtx = document.getElementById('alquileresChart').getContext('2d');
new Chart(alquileresCtx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($alquileresMeses) ?>,
        datasets: [{
            label: 'Total de alquileres',
            data: <?= json_encode($alquileresTotales) ?>,
            backgroundColor: 'rgba(255, 99, 132, 0.6)'
        }]
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
