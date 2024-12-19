<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="comprobar.php" method="post">
        <label for="login">Login del usuario: </label>
        <input type="text" id="login" name="login" required>
        <label for="clave">Clave:</label>
        <input type="password" id="clave" name="clave" required>
        <input type="submit" name="submit" value="Iniciar Sesión">
    </form>
</body>
</html>