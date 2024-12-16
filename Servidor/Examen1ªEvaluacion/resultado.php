<?php
session_start();
$fecha = date("d/m/Y");
echo "<h1>Fecha: $fecha</h1><br>";
$conn = new mysqli('localhost', 'root', '', 'jeroglifico', 3307);

$cantidadJugadoresAcertantes = "SELECT COUNT(*) AS total FROM respuestas WHERE fecha = '2024-12-12' AND respuesta = 'Que sonada'";
$jugadoresAcertantes = "SELECT login, hora FROM respuestas WHERE fecha = '2024-12-12' AND respuesta = 'Que sonada'";
$jugadoresFallaron = "SELECT login, hora FROM respuestas WHERE fecha = '2024-12-12' AND respuesta != 'Que sonada'";
//Para mostrar cuantos jugadores han acertado el jeroglifico
$resultado = $conn->query($cantidadJugadoresAcertantes);
if($resultado->num_rows > 0){
    $acertados = $resultado->fetch_assoc();
    $totalJugadoresAcertantes = $acertados['total'];
    echo "<h1>Jugadores acertantes:  $totalJugadoresAcertantes</h1>";
    }

//Para mostrar en una tabla los jugadores que acertaron
$resultadoJugadoresAcertantes = $conn->query($jugadoresAcertantes);
echo "<table border='1'>
        <tr>
            <th>Login</th>
            <th>Hora</th>
        </tr>"; 
        if($resultadoJugadoresAcertantes->num_rows > 0){
            while($fila = $resultadoJugadoresAcertantes->fetch_assoc()){

                echo "<tr>
                    <td>" .$fila['login'] ."</td>
                    <td>" .$fila['hora'] ."</td>
                    </tr>";   

            }

        }
        echo "</table>";

echo "<h1>Jugadores que han fallado</h1>";

//Para mostrar en un tabla los jugadores que fallaron
$resultadoJugadoresFallaron = $conn->query($jugadoresFallaron);
echo "<table border='1'>
        <tr>
            <th>Login</th>
            <th>Hora</th>
        </tr>"; 
        if($resultadoJugadoresFallaron->num_rows > 0){
            while($fila = $resultadoJugadoresFallaron->fetch_assoc()){
                echo "<tr>
                    <td>" .$fila['login'] ."</td>
                    <td>" .$fila['hora'] ."</td>
                    </tr>";    
            }
        }
        echo "</table>";
?>