<?php
session_name("Sesiones_1_13");
session_start();

if (!isset($_SESSION['x']) || !isset($_SESSION['y'])) {
    $_SESSION['x'] = $_SESSION['y'] = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Posición del círculo</h1>

    <form action="dato.php" method="GET">
    <button type="submit" name="accion" value="derecha">Derecha</button>
    <button type="submit" name="accion" value="arriba">Arriba</button>
    <button type="submit" name="accion" value="centro">Centro</button>
    <button type="submit" name="accion" value="abajo">Abajo</button>
    <button type="submit" name="accion" value="izquierda">Izquierda</button>
    </form>

    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="400" height="400" viewBox="-200 -200 400 400" style="border: black 2px solid">
        <?php
        print "<circle cx=\"$_SESSION[x]\" cy=\"$_SESSION[y]\" r=\"8\" fill=\"red\" />\n";   
        ?>
    </svg>
</body>
</html>
