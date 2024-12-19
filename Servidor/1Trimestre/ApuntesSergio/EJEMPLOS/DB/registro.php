<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="guardarRegistro.php" method="post">
        <label for="usu">Usuario: </label>
        <input type="text" id="usu" name="usu" required><br>
        <label for="usu">Contraseña: </label>
        <input type="password" id="psw" name="psw" required><br>
        <label for="usu">Repita la contraseña: </label>
        <input type="password" id="reppsw" name="reppsw" required><br>
        <!-- <p>Rol: </p>
        <input type="radio" id="estandar" name="rol" value="estandar" required>
        <label for="estandar">Estandar</label><br>
        <input type="radio" id="premium" name="rol" value="premium" required>
        <label for="premium">Premium</label><br> -->
        <label for="rol">Rol: </label>
        <input type="text" id="rol" name="rol" required><br>
        <a href="acceso.php">Inicie sesión</a><br>
        <input type="submit" value="Registrarse" name="submit">
    </form>
</body>
</html>