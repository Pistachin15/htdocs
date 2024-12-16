<?php
    require_once 'conexion.php';
    session_start();
    $x = $_POST['x'];
    $y = $_POST['y'];
    $barajas = $_SESSION['baraja'];
    $numIntentos = $_SESSION['cartasLevantadas'];
    $login = $_SESSION["login"];
    
    

    if ($barajas/* [$_SESSION['combinacion']] */[$x-1] == $barajas/* [$_SESSION['combinacion']] */[$y-1]) {
        /* echo "BIEN"; */
        $resp = true;
        $query = "UPDATE jugador SET puntos = ((SELECT puntos FROM jugador WHERE login='$login')+1),extra = ((SELECT extra FROM jugador WHERE login='$login')+$numIntentos) WHERE login='$login'";
        $result = $conn->query($query);
        if (!$result) die("Fatal Error");
    } else {
        /* echo "MAL"; */
        $resp = false;
        $query = "UPDATE jugador SET puntos = ((SELECT puntos FROM jugador WHERE login='$login')-1),extra = ((SELECT extra FROM jugador WHERE login='$login')+$numIntentos) WHERE login='$login'";
        $result = $conn->query($query);
        if (!$result) die("Fatal Error");
    }

    
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>
<body>
    <h1>Bienvenid@, <?php echo $_SESSION["login"] ?></h1>
    <?php
        if ($resp) {
            echo "<h2>Acierto posiciones $x y $y despues de $numIntentos intentos</h2>";
            echo "<p>Se le sumara 1 punto, asi como $numIntentos intentos</p>";
            echo "<h3>Puntos por jugador</h3>";
        } else {
            echo "<h2>Fallo posiciones $x y $y despues de $numIntentos intentos</h2>";
            echo "<p>Se le restara 1 punto, asi como $numIntentos intentos</p>";
            echo "<h3>Puntos por jugador</h3>";
        }
    ?>

    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Puntos</th>
            <th>Extra</th>
        </tr>
        <?php 
            $query = "SELECT nombre, puntos, extra FROM jugador";
            $result = $conn->query($query);
            if (!$result) die("Fatal Error");
            $rows = $result->num_rows;
            for ($i=0; $i<$rows; $i++) {
                echo "<tr>";
                $result->data_seek($i);
                echo '<td>' .htmlspecialchars($result->fetch_assoc()['nombre']).'</td>';
                $result->data_seek($i);
                echo '<td>' .htmlspecialchars($result->fetch_assoc()['puntos']).'</td>';
                $result->data_seek($i);
                echo '<td>' .htmlspecialchars($result->fetch_assoc()['extra']).'</td>';
                echo "</tr>";
            }
        ?>
    </table>

</body>
</html>

<?php
    $conn->close();
    session_destroy();
?>