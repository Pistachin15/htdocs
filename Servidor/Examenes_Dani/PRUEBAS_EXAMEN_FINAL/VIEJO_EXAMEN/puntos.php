<?php
    session_start();
    require_once('conexion.php');
    $query = "
    SELECT u.login, u.puntos FROM jugador u
    
    ";

    $result = $conn->query($query);
    if (!$result) die("Fatal Error");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <h1>Puntos por jugador</h1>
        <table>
        <tr>
            <th>Login</th>
            <th>Puntos</th>
            <th>Gráfica</th>
        </tr>
        <?php
            $rows = $result->num_rows;
            for ($j = 0 ; $j < $rows ; ++$j)
                {
                    echo "<tr>";
                    $result->data_seek($j);
                    echo '<td>' .htmlspecialchars($result->fetch_assoc()['login']) .'</td>'; 
                    $result->data_seek($j);
                    echo '<td>' .htmlspecialchars($result->fetch_assoc()['puntos']) .'</td>';
                    
                    $result->data_seek($j);
                    echo "<td><div class='bar' style='width: " . (htmlspecialchars($result->fetch_assoc()['puntos']) / 2) . "px;'></div>"
                    .'</td></tr>';
                
                }
        ?>
    </table>
    <a href="index.php">VOLVER AL INICIO</a>
</body>
</html>