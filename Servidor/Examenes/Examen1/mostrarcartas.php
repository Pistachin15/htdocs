<?php
 //session_start(); 
 // session_destroy(); //en el caso de que quieras destruir la sesion
session_start(); // Inicia una nueva sesión vacía

$usuario = $_SESSION['login'] ?? 'Invitado';
echo "<h1>Bienvenid@, $usuario </h1><br>";

$parejasCartas = ['boca_abajo.jpg', 'boca_abajo.jpg', 'boca_abajo.jpg', 'boca_abajo.jpg', 'boca_abajo.jpg', 'boca_abajo.jpg'];
$cartas = ['copas_02.jpg', 'copas_02.jpg', 'copas_03.jpg', 'copas_03.jpg', 'copas_05.jpg', 'copas_05.jpg'];

// Verificar si el usuario tiene una combinación guardada, si no, generarla
if (!isset($_SESSION['ordenCartas'])) {
    shuffle($cartas);  // Baraja solo la primera vez
    $_SESSION['ordenCartas'] = $cartas;
}
//Esto es solo para imprimir el $_SESSION['cartas'] y comprobar que de verdad se mezclaron las cartas
print_r($_SESSION['ordenCartas']);

// Inicializar contador solo si no existe
if (!isset($_SESSION['contador'])) {
    $_SESSION['contador'] = 0; 
}

// Si se presiona un botón de levantar carta
if (isset($_POST['botonCarta'])) {
    $valorBoton = (int) $_POST['botonCarta']; // Asegurarse de que es un número entero

    $_SESSION['contador']++;

    // Modificar solo la carta en la posición seleccionada
    $indiceSeleccionado = $valorBoton - 1; // Convertir botón a índice de array

    if (isset($parejasCartas[$indiceSeleccionado])) {  //Si existe el boton que clicamos de levantar carta, procedera con la condición
        $parejasCartas[$indiceSeleccionado] = $_SESSION['ordenCartas'][$indiceSeleccionado]; //Pedimos que lo cambie por el de $_SESSION['ordenCartas'], ya que $cartas nunca cambia
    }
}

if(isset($_POST['Comprobar'])){
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $_SESSION['Posicion1'] = $num1;
    $_SESSION['Posicion2'] = $num2;

    if($_SESSION['ordenCartas'][$num1 - 1] == $_SESSION['ordenCartas'][$num2 - 1]){
        $_SESSION['resultado'] = true;
        header('Location: resultado.php');
    }
    else{
        $_SESSION['resultado'] = false;
        header('Location: resultado.php');
    }
}


// Mostrar contador actualizado
$contador = $_SESSION['contador'];
echo "<h1>Cartas Levantadas: $contador</h1>";
?>

<html lang="es">
    <head>
        <style>
        .cartas {
            display: flex;
            justify-content: center;
            gap: 10px; /* Espacio entre cartas */
            margin-top: 20px;
        }

        .cartas img {
            width: 200px; /* Ajusta el ancho */
            height: 400px; /* Ajusta la altura */
        }
        </style>
    </head>
<body>

<article>
    <form action="mostrarcartas.php" method="post" class="mi-formulario">
        <?php
        for ($i = 1; $i < 7; $i++) {
            echo "<button type='submit' name='botonCarta' value='$i'>Levantar carta $i</button> ";
        }
        ?>
    </form>
</article>

<br>

<article>
    <form action="#" method="post" class="mi-formulario">
        <label for="num1">Número 1:</label>
        <input type="text" id="num1" name="num1" required>

        <label for="num2">Número 2:</label>
        <input type="text" id="num2" name="num2" required>

        <input type="submit" value="Comprobar" name="Comprobar">
    </form>
</article>

<div class="cartas">
    <!-- Aquí podrías mostrar las cartas de la sesión si es necesario -->
     <?php 
        for($j = 0; $j < 6; $j++){
            echo "<img src= imagenes/$parejasCartas[$j]>";
        }
     ?>
</div>

</body>
</html>
