<?php
session_start();
$nombreUsu = $_SESSION['nombreUsu'];
echo "<h1>Bienvenid@, $nombreUsu</h1>";
$arrayFinal = $_SESSION["arrayFinal"];
$mostrarCartas = [1,1,2,2,3,3];
shuffle($mostrarCartas);

for ($i = 0; $i < 6; $i++){
    $CartasBocaAbajo [$i] = 'boca_abajo.jpg';
    var_dump($CartasBocaAbajo);
    if(isset($_POST["boton'$i'"])){
        $_SESSION['contador'] ++;
        
            $CartasBocaAbajo[$i] = $MostrarCartas[$i];
            
            for ($i = 0; $i < 6; $i++){
                switch($CartasBocaAbajo[$i]){
                    case 'boca_abajo.jpg':
                        echo "<img src='img/copas_abajo.jpg'>";  
                        break;
                    case 1:
                        echo "<img src='img/copas_02.jpg'>";
                        break;
                    case 2:
                        echo "<img src='img/copas_03.jpg'>";
                        break;
                    case 3:
                        echo "<img src='img/copas_05.jpg'>";
                }
    
            }
            

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Estilo para las imágenes */
        .cartas {
            display: inline-block; 
            margin-right: 10px;
            transform: rotate(90deg);
        }
    </style>
</head>
<body>
    <article>
        <form action="#" method="post" class="mi-formulario">
        <?php
            for ($i = 0; $i < 6; $i++){
                $j=$i+1;
                echo "<input type='submit' value='Levantar carta $j' name=boton$i>";
            }
        ?>
            <br><br>
            <h1>Pareja:</h1>
            <input type="text" value="Pareja1" name=Pareja1>
            <input type="text" value="Pareja2" name=Pareja2>
            <input type="submit" value="Comprobar" name=Comprobar>
        </form>
        <br><br>
    </article>
    </body>
</html>
        <?php
        for($i = 0; $i < 6; $i++){
            
            echo "<img class='cartas' width='200px' src='img/{$CartasBocaAbajo[$i]}'>";
            $_SESSION["arrayFinal"] = $CartasBocaAbajo[$i]; 
        }    
        ?>
