<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Insertar Película</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
      background-color: #f8f9fa;
    }
    .form-container {
      min-height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }
    .form-card {
      background: #fff;
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 0 1rem rgba(0,0,0,0.1);
      width: 100%;
      max-width: 600px;
    }
  </style>
</head>
<body>

<div class="container form-container">
  <div class="form-card">
    <h3 class="text-center mb-4">Insertar Nueva Película</h3>

    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
      <div class="alert alert-success text-center">¡Película insertada correctamente!</div>
    <?php endif; ?>

    <form action="logicaPelicula.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate onsubmit="return validarFormulario();">
      <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" required>
        <div class="invalid-feedback">Por favor, introduce un título.</div>
      </div>

      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        <div class="invalid-feedback">Por favor, escribe una descripción.</div>
      </div>

      <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" class="form-control" id="stock" name="stock" min="0" required>
        <div class="invalid-feedback">El stock no puede ser negativo.</div>
      </div>

      <div class="mb-3">
        <label for="precio_compra" class="form-label">Precio de Compra (€)</label>
        <input type="number" step="0.01" class="form-control" id="precio_compra" name="precio_compra" min="0" required>
        <div class="invalid-feedback">Introduce un precio válido.</div>
      </div>

      <div class="mb-3">
        <label for="precio_alquiler" class="form-label">Precio de Alquiler (€)</label>
        <input type="number" step="0.01" class="form-control" id="precio_alquiler" name="precio_alquiler" min="0" required>
        <div class="invalid-feedback">Introduce un precio válido.</div>
      </div>

      <div class="mb-3">
        <label for="imagen" class="form-label">Imagen de la Película</label>
        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
        <div class="invalid-feedback">Selecciona una imagen válida.</div>
      </div>

      <input type="hidden" name="tipo" value="película">

      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">Insertar</button>
        <a href="../../../index.php" class="btn btn-secondary">Volver al Inicio</a>
      </div>
    </form>
  </div>
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

  // Validación visual con Bootstrap
  (() => {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();
</script>

</body>
</html>
