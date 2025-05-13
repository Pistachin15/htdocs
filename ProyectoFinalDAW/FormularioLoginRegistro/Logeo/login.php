<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Level-Up Video | Login</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Font retro -->
  <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

  <div class="login-container text-center">
    <h4 class="mb-4">LEVEL-UP VIDEO</h4>

    <!-- Formulario de Login -->
    <form action="logicaLogin.php" method="post">
      <div class="mb-3 text-start">
        <label for="usuario" class="form-label">Usuario:</label>
        <input type="text" class="form-control" name="usuario" id="usuario" required>
      </div>
      <div class="mb-3 text-start">
        <label for="password" class="form-label">Contraseña:</label>
        <input type="password" class="form-control" name="password" id="password" required>
      </div>
      <button type="submit" class="btn btn-login w-100 mb-2">Iniciar sesión</button>
    </form>

    <hr class="my-3 border-light">

    <!-- Botón de Registro -->
    <form action="../Registro/registro.html" method="get">
      <button type="submit" class="btn btn-register w-100">Registrarse</button>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
