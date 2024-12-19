<html lang="es">
    <head>
    <link rel="stylesheet" href="Estilos.css">
    </head>
<body>


 <header>

    </header>

    <article>
        <form action="#" method="post" class="mi-formulario">
            <label for="mes">Introduce un mes:</label>
            <input type="text" id="num1" name="mes" required>
            <label for="año">Introduce un año:</label>
            <input type="text" id="num2" name="año" required>
            <input type="submit" value="Enviar" name=boton>
        </form>
    </article>

</body>

</html>

<?php
if (isset($_POST['boton'])) {

    $mes = $_POST['mes'];
    $año = $_POST['año'];
    
    $primerDiaMes = strtotime("$año-$mes-01"); 
    $primerDiaSemanaMes = date("w", $primerDiaMes); 
    
    $DiasMes = date('t', $primerDiaMes); 
    
    $ultimoDiaMes = strtotime("$año-$mes-$DiasMes"); 
    $ultimoDiaSemanaMes = date("w", $ultimoDiaMes);
    
    switch ($primerDiaSemanaMes) {
        case 0: // Domingo
            $primerDiaSemanaConvertido = 7;
            break;
        case 1: // Lunes
            $primerDiaSemanaConvertido = 1;
            break;
        case 2: // Martes
            $primerDiaSemanaConvertido = 2;
            break;
        case 3: // Miércoles
            $primerDiaSemanaConvertido = 3;
            break;
        case 4: // Jueves
            $primerDiaSemanaConvertido = 4;
            break;
        case 5: // Viernes
            $primerDiaSemanaConvertido = 5;
            break;
        case 6: // Sábado
            $primerDiaSemanaConvertido = 6;
            break;
        default:
            $primerDiaSemanaConvertido = null; // En caso de un valor inesperado
    }

    switch ($ultimoDiaSemanaMes) {
        case 0: // Domingo
            $ultimoDiaSemanaConvertido = 7;
            break;
        case 1: // Lunes
            $ultimoDiaSemanaConvertido = 1;
            break;
        case 2: // Martes
            $ultimoDiaSemanaConvertido = 2;
            break;
        case 3: // Miércoles
            $ultimoDiaSemanaConvertido = 3;
            break;
        case 4: // Jueves
            $ultimoDiaSemanaConvertido = 4;
            break;
        case 5: // Viernes
            $ultimoDiaSemanaConvertido = 5;
            break;
        case 6: // Sábado
            $ultimoDiaSemanaConvertido = 6;
            break;
        default:
            $ultimoDiaSemanaConvertido = null; // En caso de un valor inesperado
    }
    
    echo "El primer día del mes $mes/$año es un " . $primerDiaSemanaConvertido . "<br>";
    echo "El último día del mes $mes/$año es un " . $ultimoDiaSemanaConvertido . "<br>";
    echo "El mes tiene $DiasMes días<br>";

    ?>
    
    <table>
    <tr>
        <th>Lunes</th>
        <th>Martes</th>
        <th>Miércoles</th>
        <th>Jueves</th>
        <th>Viernes</th>
        <th>Sábado</th>
        <th>Domingo</th>
    </tr>
    <?php

    echo "<tr>";

    // Añadir celdas vacías antes del primer día del mes
    for ($i = 0; $i < $primerDiaSemanaConvertido; $i++) {
        echo "<td></td>";
    }

    // Imprimir los días del mes
    for ($dia = 1; $dia <= $DiasMes; $dia++) {
        echo "<td>$dia</td>";
        
        // Si es domingo, cerrar la fila y abrir una nueva
        if (($dia + $primerDiaSemanaConvertido) % 7 == 0) {
            echo "</tr><tr>";
        }
    }

    // Añadir celdas vacías después del último día del mes
    $lastDayOfWeek = ($DiasMes + $primerDiaSemanaConvertido) % 7;
    if ($lastDayOfWeek != 0) {
        for ($i = $lastDayOfWeek; $i < 7; $i++) {
            echo "<td></td>";
        }
    }

    echo "</tr>";
    ?>
    </table>

    <?php
} 
?>
