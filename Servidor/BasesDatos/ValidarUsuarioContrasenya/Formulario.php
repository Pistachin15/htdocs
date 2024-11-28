<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Login y Registro</title>
   
</head>
<body>
    <form action="Logica.php" method="post" class="mi-formulario">
        <h2>Formulario de Login y Registro</h2>
        <label for="username">Usuario:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>

        <br><button type="submit" name="login">Iniciar Sesión</button>
        <bv></bv><button type="submit" name="register">Registrarse</button>
    </form>
</body>
</html>
