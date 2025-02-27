<?php
    //^Una vez más iniciamos la sesión
    session_start();
    require_once 'conexion.php';
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die("Fatal Error");
    //^Empezamos la consulta
    //^Dentro de esta como vamos a usar dos tablas pues identificamos 
    //^La de usuario con u y la de contactos con c 
    $query = "
    SELECT u.Codigo, u.Nombre, c.contactos AS contactos FROM usuarios u
    LEFT JOIN 
        (
            SELECT codusuario, COUNT(*) AS contactos FROM contactos 
            GROUP BY 
                codusuario
        ) c
    ON 
        u.Codigo = c.codusuario
    ";

    $result = $connection->query($query);
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
        /* .bar {
            background-color: blue;
            height: 20px;
        } */
         //!Creamos unos mini circulos
        .circulo {
            background-color: red;
            height: 20px;
            width: 20px;
            border-radius: 50px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <h1>AGENDA</h1>
    <h2>Hola <?php echo  $_SESSION['usu'];?></h2>
    <!-- Creamos en html la tabla -->
    <table>
        <tr>
            <th>Código usuario</th>
            <th>Nombre</th>
            <th>Número de contactos</th>
            <th>Gráfica</th>
        </tr>
        <?php
            $rows = $result->num_rows;
            for ($j = 0 ; $j < $rows ; ++$j)
                {
                    //^En el primer tr depues de leer todas las columnas*
                    echo "<tr>";
                    $result->data_seek($j);
                    echo '<td>' .htmlspecialchars($result->fetch_assoc()['Codigo']) .'</td>';//^Mostramos todo lo asociado a Coadigo
                    $result->data_seek($j);
                    echo '<td>' .htmlspecialchars($result->fetch_assoc()['Nombre']) .'</td>';//^El nombre del usuario
                    //^Y finalmente se contarán los contactos
                    $result->data_seek($j);
                    $numcontactos = htmlspecialchars($result->fetch_assoc()['contactos']);
                    if ($numcontactos == "") {
                        $numcontactos = 0;
                    }
                    echo '<td>' .$numcontactos .'</td><td>';
                    //^Los contactos se verán con circulos en función del número de ellos que haya
                    //^De nuevo usamos un for
                    for ($i = 0 ; $i < $numcontactos ; ++$i) {
                        echo "<div class='circulo'></div>";
                    }
                    echo '</td></tr>';


                
                }
        ?>
        
    </table>
    <a href="index.php">Volver a loguearse</a><br>
    <a href="inicio.php">Introducir más contactos para <?php echo  $_SESSION['usu'];?></a><br>
</body>
</html>