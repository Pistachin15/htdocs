<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario de Login</title>
        <!-- Enlace a Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    
        <div class="bg-white p-4 rounded shadow-sm w-100" style="max-width: 350px;">
            <h4 class="text-center mb-3">Iniciar sesión</h4>
            <!-- Formulario de Login -->
            <form action="RegistroUsuario/LogicaLogin.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Usuario:</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
            </form>
    
            <!-- Separador -->
            <hr class="my-3">
    
            <!-- Botón de Registro dentro del mismo contenedor -->
            <form action="RegistroUsuario/FormularioRegistro.php" method="get">
                <button type="submit" class="btn btn-success w-100">Registrarse</button>
            </form>
        </div>
    
        <!-- Enlace a Bootstrap JS (Opcional si necesitas JS de Bootstrap) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
