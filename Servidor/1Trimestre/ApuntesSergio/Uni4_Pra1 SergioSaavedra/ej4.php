<?php
/*
    Construir un calendario, se ha de introducir un mes y un año y al pulsar el botón
    ENVIAR, a partir de esos datos, con las funciones de PHP para trabajar con fechas se
    ha de dibujar el calendario del mes y año indicado. Se ha de controlar el número de
    días, así como el día de la semana en que empieza dicho mes. El resultado se ha de
    mostrar en formato tabla de HTML y se ha de resolver en un solo script.
*/
if (isset($_POST['mes'])) {
    
    $primerDia = mktime(0,0,0,$_POST['mes'],1,$_POST['anno']);
    $diaSemana = date('w', $primerDia);
    $diasMes = date('t', $primerDia);

    $diasSemana = ['L','M','X','J','V','S','D'];
    echo<<<_END
    <style>
        caption, th {
            background-color: blue;
            color: white;
        }
    </style>
    _END;
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<caption style='border: 1px solid'>Calendario ".$_POST['anno']."</caption>";
    echo "<tr>";
    foreach ($diasSemana as $dia) {
        echo "<th>$dia</th>";
    }
    echo "</tr><tr>";
    for ($i=0; $i<$diaSemana-1; $i++) {
        echo "<td></td>";
    }
    for ($dia =1; $dia<=$diasMes; $dia++) {
        if (($dia+$diaSemana-2)% 7 == 0 && $dia != 1) {
            echo "</tr><tr>";
        }
        echo "<td>",$dia,"</td>";
    }
    while (($dia + $diaSemana-2) % 7 != 0) {
        echo "<td></td>";
        $dia++;
    }
    echo "</tr></table>";
} else {
    echo <<<_END
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <form action="#" method="post">
                <label for="mes">Introduce un mes:</label>
                <input type="number" id="mes" name="mes" required>

                <label for="anno">Introduce un año:</label>
                <input type="number" id="anno" name="anno" required>

                <input type="submit" value="Enviar">
            </form>
        </body>
        </html>
    _END;
}
?>