<?php
$mensaje = $_GET['mensaje'] ?? '';
$tipo_mensaje = $_GET['tipo'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agregar Película</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h4 class="card-title text-center mb-4">Agregar Película</h4>

            <?php if ($mensaje): ?>
              <div class="alert alert-<?= $tipo_mensaje === 'error' ? 'danger' : 'success' ?>" role="alert">
                <?= htmlspecialchars($mensaje) ?>
              </div>
            <?php endif; ?>

            <form action="logicaPelicula.php" method="post" enctype="multipart/form-data" novalidate>
              <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" name="titulo" id="titulo" class="form-control" required>
              </div>

              <input type="hidden" name="tipo" value="película">

              <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3"></textarea>
              </div>

              <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" min="0" required>
              </div>

              <div class="mb-3">
                <label for="precio_compra" class="form-label">Precio de Compra (€)</label>
                <input type="number" name="precio_compra" id="precio_compra" class="form-control" step="0.01" min="0" required>
              </div>

              <div class="mb-3">
                <label for="precio_alquiler" class="form-label">Precio de Alquiler (€)</label>
                <input type="number" name="precio_alquiler" id="precio_alquiler" class="form-control" step="0.01" min="0" required>
              </div>

              <div class="mb-3">
                <label for="imagen" class="form-label">Imagen <span class="text-danger">*</span></label>
                <input type="file" name="imagen" id="imagen" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp" required>
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-success">Agregar Película</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
