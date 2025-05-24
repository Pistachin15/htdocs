<?php
session_start();
require_once '../../login.php'; // contiene $hn, $db, $un, $pw

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Ya no redirigimos si no hay sesión iniciada

$sql = "SELECT * FROM productos WHERE tipo = 'película'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Películas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
    <h1 class="mb-4 text-center">Catálogo de Películas</h1>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <?php if (!empty($row['imagen'])): ?>
                        <img src="/ProyectoFinalDAW/Administrador/Formularios_Insert_Productos/Peliculas/<?= htmlspecialchars($row['imagen']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['titulo']) ?>">
                    <?php else: ?>
                        <div class="card-img-top bg-secondary text-white text-center p-5">Sin imagen</div>
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['titulo']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($row['descripcion']) ?></p>
                    </div>

                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador'): ?>
                        <div class="card-footer d-flex justify-content-between">
                            <form action="editar_pelicula.php" method="get">
                                <input type="hidden" name="id" value="<?= $row['id_producto'] ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Editar</button>
                            </form>
                            <form action="borrar_pelicula.php" method="post" onsubmit="return confirm('¿Estás seguro de borrar esta película?');">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
