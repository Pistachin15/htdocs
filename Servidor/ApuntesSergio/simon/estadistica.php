<?php
    session_start();
    require_once 'login.php';
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die("Fatal Error");
    $query = "
    SELECT u.Codigo, u.Nombre, j.aciertos AS aciertos FROM usuarios u
    LEFT JOIN 
        (
            SELECT codigousu, COUNT(*) AS aciertos FROM jugadas WHERE acierto = 1 
            GROUP BY 
                codigousu
        ) j
    ON 
        u.Codigo = j.codigousu
    ";

    $result = $connection->query($query);
    if (!$result) die("Fatal Error");
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadistica</title>
    <style>
        table {
            border: 1px solid black;
            
            
            text-align: left;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        .bar {
            background-color: blue;
            height: 20px;
        }
    </style>
</head>
<body>
    <h1>SIMÓN</h1>
    <h2><?php echo $_GET['usuario']; ?>, los resultados son:</h2>
    <table>
        <tr>
            <th>Código usuario</th>
            <th>Nombre</th>
            <th>Número aciertos</th>
            <th>Gráfica</th>
        </tr>
        <?php
            $rows = $result->num_rows;
            for ($j = 0 ; $j < $rows ; ++$j)
                {
                    echo "<tr>";
                    $result->data_seek($j);
                    echo '<td>' .htmlspecialchars($result->fetch_assoc()['Codigo']) .'</td>'; 
                    $result->data_seek($j);
                    echo '<td>' .htmlspecialchars($result->fetch_assoc()['Nombre']) .'</td>';
                    $result->data_seek($j);
                    echo '<td>' .htmlspecialchars($result->fetch_assoc()['aciertos']) .'</td>';
                    $result->data_seek($j);
                    echo "<td><div class='bar' style='width: " . (htmlspecialchars($result->fetch_assoc()['aciertos']) * 10) . "px;'></div>"
                    .'</td></tr>';
                
                }
        ?>
    </table>
    <a href="index.php">VOLVER AL INICIO</a>
</body>
</html>
<?php

    $connection->close();
?>