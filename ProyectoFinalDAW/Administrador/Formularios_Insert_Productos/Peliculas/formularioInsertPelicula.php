<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Insertar Película</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
  <div class="container">
    <h2 class="mb-4">Insertar Nueva Película</h2>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
      <div class="alert alert-success">¡Pelicula insertada correctamente!</div>
    <?php endif; ?>

    <form action="logicaPelicula.php" method="POST" enctype="multipart/form-data" onsubmit="return validarFormulario();">
      <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" required>
      </div>
      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
      </div>
      <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" class="form-control" id="stock" name="stock" min="0" required>
      </div>
      <div class="mb-3">
        <label for="precio_compra" class="form-label">Precio de Compra (€)</label>
        <input type="number" step="0.01" class="form-control" id="precio_compra" name="precio_compra" min="0" required>
      </div>
      <div class="mb-3">
        <label for="precio_alquiler" class="form-label">Precio de Alquiler (€)</label>
        <input type="number" step="0.01" class="form-control" id="precio_alquiler" name="precio_alquiler" min="0" required>
      </div>
      <div class="mb-3">
        <label for="imagen" class="form-label">Imagen de la Película</label>
        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
      </div>
      <input type="hidden" name="tipo" value="película">
      <button type="submit" class="btn btn-primary">Insertar</button>
      <div class="mt-3">
            <a href="../../../index.php" class="btn btn-secondary">Volver al Inicio</a>
      </div>
    </form>
  </div>

  <script>
    function validarFormulario() {
      const stock = document.getElementById("stock").value;
      const precioCompra = document.getElementById("precio_compra").value;
      const precioAlquiler = document.getElementById("precio_alquiler").value;

      if (stock < 0 || precioCompra < 0 || precioAlquiler < 0) {
        alert("Los valores numéricos no pueden ser negativos.");
        return false;
      }

      return true;
    }
  </script>
</body>
</html>
