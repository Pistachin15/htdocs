<?php
session_start();
$rol = $_SESSION['rol'] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Seleccionar Opción</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

  <style>
    
    html, body {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
      background-color: #f8f9fa;
    }

    body > .container, 
    body > nav,
    body > footer {
      flex-shrink: 0;
    }

    .content-wrapper {
      flex: 1 0 auto;
    }

    .card-option {
      transition: transform 0.2s;
      cursor: pointer;
    }

    .card-option:hover {
      transform: scale(1.05);
    }

    .card-option .card-body {
      padding: 2rem;
    }

    .card-option i {
      font-size: 3rem;
      margin-bottom: 1rem;
      color: #0d6efd;
    }

    footer {
      flex-shrink: 0;
      background-color: #212529; 
      color: white;
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

<div class="content-wrapper container py-5">
  <h2 class="text-center mb-5">Selecciona qué tipo de producto deseas insertar</h2>
  <div class="row justify-content-center">
    <div class="col-12 col-md-4 mb-4">
      <a href="Formularios_Insert_Productos/Videojuegos/formularioInsertVideojuego.php" class="text-decoration-none">
        <div class="card card-option text-center shadow-sm">
          <div class="card-body">
            <i class="bi bi-controller"></i>
            <h5 class="card-title">Videojuegos</h5>
          </div>
        </div>
      </a>
    </div>
    <div class="col-12 col-md-4 mb-4">
      <a href="Formularios_Insert_Productos/Peliculas/formularioInsertPelicula.php" class="text-decoration-none">
        <div class="card card-option text-center shadow-sm">
          <div class="card-body">
            <i class="bi bi-film"></i>
            <h5 class="card-title">Películas</h5>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>

<footer class="py-4 text-center">
  <div class="container">
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
