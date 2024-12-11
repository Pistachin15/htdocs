<?php
session_start();
$nombreUsu = $_SESSION['nombreUsu'] ?? 'Invitado';
echo "<h1>Bienvenid@, $nombreUsu</h1>";

$bocaAbajo = 'boca_abajo.jpg';

// Inicializar las cartas si no están ya en la sesión
if (!isset($_SESSION['cartas'])) {
    $cartas = [2, 2, 3, 3, 5, 5];
    shuffle($cartas);
    $_SESSION['cartas'] = $cartas; // Guardar el array de cartas en la sesión
}

// Inicializar el contador de clics si no existe
if (!isset($_SESSION['contadorClics'])) {
    $_SESSION['contadorClics'] = 0;
}

// Recuperar las cartas desde la sesión
$cartas = $_SESSION['cartas'];

// Almacenar el índice de la carta levantada y aumentar el contador
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['boton'])) {
    $_SESSION['cartaLevantada'] = $_POST['boton'];
    $_SESSION['contadorClics']++; // Incrementar el contador de clics
} else {
    $_SESSION['cartaLevantada'] = null;
}

// Comprobar si se introdujo una pareja correcta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['num1']) && isset($_POST['num2'])) {
    $num1 = (int)$_POST['num1'];
    $num2 = (int)$_POST['num2'];

    // Verificar si los dos índices son una pareja correcta
    if ($num1 >= 0 && $num1 < 6 && $num2 >= 0 && $num2 < 6 && $cartas[$num1] === $cartas[$num2] && $num1 !== $num2) {
        header('Location: ganar.php');
        exit;
    } else {
        echo "<p style='color:red;'>La pareja no es correcta o los índices son inválidos.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        img {
            padding: 10px;
        }
    </style>
    <title>Juego de Cartas</title>
</head>
<body>
    <form method="post" action="">
        <?php
        echo "<label for='cartasLevantadas'>Cartas Levantadas:</label><br>";
        for ($i = 0; $i < 6; $i++) {
            echo "<button type='submit' name='boton' value='$i'>Botón $i</button> ";
        }
        ?>
    </form>
    <br>

    <form method="post" action="">
        <label for="num1">Primer número:</label>
        <input type="number" id="num1" name="num1" min="0" max="5" required>

        <label for="num2">Segundo número:</label>
        <input type="number" id="num2" name="num2" min="0" max="5" required>

        <button type="submit">Comprobar</button>
    </form>
    <br>

    <?php
    // Mostrar el contador de clics
    echo "<p>Contador de clics: {$_SESSION['contadorClics']}</p>";

    // Mostrar las cartas
    for ($i = 0; $i < 6; $i++) {
        if (isset($_SESSION['cartaLevantada']) && $_SESSION['cartaLevantada'] == $i) {
            // Mostrar la carta seleccionada
            echo "<img src='img/copas_0{$cartas[$i]}.jpg'>";
        } else {
            // Mostrar la carta boca abajo
            echo "<img src='img/$bocaAbajo'>";
        }
    }
    ?>
</body>
</html>