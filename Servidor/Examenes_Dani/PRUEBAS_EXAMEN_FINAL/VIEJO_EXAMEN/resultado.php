<?php
    session_start();
    
    require_once('conexion.php');
    $query = "SELECT solucion  FROM solucion WHERE fecha = '2024-12-12'"; 
    $result = $conn->query($query);
    if (!$result) die("Fatal Error");

    $result->data_seek(0);
    $solucion = htmlspecialchars($result->fetch_assoc()['solucion']);
    
    $query = "SELECT hora, fecha, login, respuesta, COUNT(*) AS acertantes from respuestas WHERE respuesta = '$solucion'";
    
    $result = $conn->query($query);
    if (!$result) die("Fatal Error");
    $result->data_seek(0);
    $aciertos = htmlspecialchars($result->fetch_assoc()['acertantes']);
    $query = "SELECT hora, fecha, login, respuesta from respuestas WHERE respuesta = '$solucion'";
    
    $result = $conn->query($query);
    if (!$result) die("Fatal Error");
    
?>

<!DOCTYPE html>
<html lang="es">
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
    <h1>Fecha: <?php  $_SESSION['fecha']?></h1>
    <h2>Juagadores acertantes: <?php echo $aciertos?></h2>
    <table>
        <tr>
            <th>Login</th>
            <th>Hora</th>
        </tr>
        <?php
            $rows = $result->num_rows;
            for ($j = 0 ; $j < $rows ; ++$j)
                {
                    echo "<tr>";
                    $result->data_seek($j);
                    $login = htmlspecialchars($result->fetch_assoc()['login']);
                    echo '<td>' . $login .'</td>'; 
                    $query2 = "UPDATE jugador SET puntos = ((SELECT puntos FROM jugador WHERE login='$login')+1),extra = ((SELECT extra FROM jugador WHERE login='$login')+0) WHERE login='$login'";
                    $result2 = $conn->query($query2);
                    if (!$result2) die("Fatal Error"); 
                    $result->data_seek($j);
                    echo '<td>' .htmlspecialchars($result->fetch_assoc()['hora']) .'</td></tr>';
                   
                
                }
        ?>
    </table>

    <h2>Juagadores que han fallado</h2>
    <table>
        <tr>
            <th>Login</th>
            <th>Hora</th>
        </tr>
        <?php
            $query = "SELECT hora, fecha, login, respuesta from respuestas WHERE respuesta != '$solucion' AND fecha = '2024-12-12'";
        
            $result = $conn->query($query);
            if (!$result) die("Fatal Error");
            $rows = $result->num_rows;
            for ($j = 0 ; $j < $rows ; ++$j)
                {
                    echo "<tr>";
                    $result->data_seek($j);
                    $login = htmlspecialchars($result->fetch_assoc()['login']);
                    echo '<td>' . $login .'</td>'; 

                    $result->data_seek($j);
                    echo '<td>' .htmlspecialchars($result->fetch_assoc()['hora']) .'</td></tr>';
                   
                
                }
        ?>
    </table>
    <a href="index.php">VOLVER AL INICIO</a>
</body>
</html>