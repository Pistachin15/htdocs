<?php
    /* session_start(); */
    require_once 'pintarCartas.php';
    if(!isset($_POST["lev"])) {
        $_SESSION['cartasLevantadas'] = 0;
        $levanta = -1;
        

    } else {
        $levanta = intval((substr($_POST["lev"], -1)));
        $_SESSION['cartasLevantadas']++;
    }

    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenid@, <?php echo $_SESSION["login"] ?></h1>
    <form action="#" method="post">
        <label>Cartas levantadas: </label>
        <input type="number" id="cLevantada" name="cLevantada" value="<?php echo $_SESSION['cartasLevantadas'];?>" disabled><br><br>
        <input type="submit" value="Levantar carta 1" name="lev">
        <input type="submit" value="Levantar carta 2" name="lev">
        <input type="submit" value="Levantar carta 3" name="lev">
        <input type="submit" value="Levantar carta 4" name="lev">
        <input type="submit" value="Levantar carta 5" name="lev">
        <input type="submit" value="Levantar carta 6" name="lev">
        <br><br>
        
    </form>
    <form action="resultado.php" method="post">
        <span>Pareja: </span><input type="number" id="x" name="x" min="1" max="6" required><input type="number" id="y" name="y" min="1" max="6" required>
        <input type="submit" value="Comprobar">
    </form>
    <br><br>
    <div class="cartas">
        <?php pintar($levanta);?>
    </div>
</body>
</html>