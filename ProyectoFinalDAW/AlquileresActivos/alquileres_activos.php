<?php
session_start();
require_once '../login.php';

$conn = new mysqli($hn, $un, $pw, $db);

if (!isset($_SESSION['nombreUsu'])) {
    header("Location: ../FormularioLoginRegistro/Logeo/login.php?mensaje=cesta");
    exit;
}

$id_usuario = $_SESSION['id_usu'];
$rol = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alquileres Activos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        .content-wrapper {
            flex: 1;
        }
        .table td, .table th {
            white-space: nowrap;
        }
        @media (max-width: 576px) {
            .table-responsive {
                overflow-x: auto;
            }
            .btn-sm {
                padding: 0.5rem 1rem;
                font-size: 1rem;
                width: 100%;
                margin-top: 0.3rem;
            }
            .table td, .table th {
                text-align: center;
                white-space: normal;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="../index.php">Level Up Video</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="../index.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="../Catalogos/CatalogoPelicula/catalogo_peliculas.php">Películas</a></li>
                <li class="nav-item"><a class="nav-link" href="../Catalogos/CatalogoVideojuego/catalogo_videojuegos.php">Juegos</a></li>
                <li class="nav-item"><a class="nav-link active" href="alquileres_activos.php">Alquileres Activos</a></li>

                <li class="nav-item mx-2 mt-2 mt-lg-0">
                    <a href="../Carrito/ver_cesta.php" class="btn btn-outline-primary">
                        🛒 Cesta (<?= count($_SESSION['cesta'] ?? []) ?>)
                    </a>
                </li>
                <li class="nav-item mx-2 mt-2 mt-lg-0">
                    <a href="../CarritoAlquiler/ver_cesta_alquiler.php" class="btn btn-outline-primary">
                        🎞 Cesta Alquiler (<?= count($_SESSION['cesta_alquiler'] ?? []) ?>)
                    </a>
                </li>

                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador'): ?>
                    <li class="nav-item dropdown mx-2 mt-2 mt-lg-0">
                        <a class="nav-link dropdown-toggle btn btn-success text-white" href="#" id="adminMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                    <li class="nav-item me-2 d-flex align-items-center text-white mt-2 mt-lg-0">
                        Bienvenido, <?= htmlspecialchars($_SESSION['nombreUsu']) ?>
                    </li>
                    <li class="nav-item mt-2 mt-lg-0"><a class="nav-link btn btn-danger text-white" href="../logout.php">Cerrar sesión</a></li>
                <?php else: ?>
                    <li class="nav-item dropdown mt-2 mt-lg-0">
                        <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li><a class="dropdown-item" href="../FormularioLoginRegistro/Logeo/login.php">Iniciar sesión</a></li>
                            <li><a class="dropdown-item" href="../FormularioLoginRegistro/Registro/registro.php">Registrarse</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="content-wrapper">
    <div class="container my-5">
        <h2 class="mb-4 text-center">Alquileres Activos</h2>

        <?php
        if ($rol === 'administrador') {
            $stmt = $conn->prepare("
                SELECT a.*, p.titulo, p.imagen, p.tipo, u.username, DATEDIFF(NOW(), a.fecha_alquiler) AS dias_transcurridos
                FROM alquileres a
                JOIN productos p ON a.id_producto = p.id_producto
                JOIN usuarios u ON a.id_usuario = u.id_usuario
                WHERE a.devuelto = 0
            ");
        } else {
            $stmt = $conn->prepare("
                SELECT a.*, p.titulo, p.imagen, p.tipo, DATEDIFF(NOW(), a.fecha_alquiler) AS dias_transcurridos
                FROM alquileres a
                JOIN productos p ON a.id_producto = p.id_producto
                WHERE a.id_usuario = ? AND a.devuelto = 0
            ");
            $stmt->bind_param("i", $id_usuario);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            echo "<div class='alert alert-info'>No hay alquileres activos.</div>";
        } else {
            echo "<div class='table-responsive'>
                    <table class='table table-bordered table-hover align-middle'>
                        <thead class='table-dark text-center'>
                            <tr>
                                <th>Título</th>
                                <th>Tipo</th>
                                <th>Fecha de alquiler</th>";
            if ($rol === 'administrador') {
                echo "<th>Usuario</th><th>Días transcurridos</th>";
            }
            echo "<th>Estado</th>";
            if ($rol === 'administrador') {
                echo "<th>Acción</th>";
            }
            echo "</tr></thead><tbody>";

            while ($row = $result->fetch_assoc()) {
                $dias = intval($row['dias_transcurridos']);
                $estado = $dias < 3 
                    ? "<span class='text-success fw-bold'>✔️</span>" 
                    : "<span class='text-danger fw-bold'>❌</span>";

                echo "<tr>
                        <td>" . htmlspecialchars($row['titulo']) . "</td>
                        <td>" . htmlspecialchars($row['tipo']) . "</td>
                        <td>" . htmlspecialchars($row['fecha_alquiler']) . "</td>";

                if ($rol === 'administrador') {
                    echo "<td>" . htmlspecialchars($row['username']) . "</td>
                          <td class='text-center'>" . $dias . " días</td>";
                }

                echo "<td class='text-center'>" . $estado . "</td>";

                if ($rol === 'administrador') {
                    echo "<td class='text-center'>
                            <form method='POST' action='finalizar_alquiler.php' class='d-inline'>
                                <input type='hidden' name='id_alquiler' value='" . intval($row['id_alquiler']) . "'>
                                <input type='hidden' name='id_producto' value='" . intval($row['id_producto']) . "'>
                                <button type='submit' class='btn btn-sm btn-danger'>Finalizar</button>
                            </form>
                        </td>";
                }

                echo "</tr>";
            }

            echo "</tbody></table></div>";
        }

        $conn->close();
        ?>
    </div>
</div>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
