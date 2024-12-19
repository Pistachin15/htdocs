<?php
    
    session_start();
    require_once "pintar-circulos.php";
    require_once "login.php";

    $usu = $_SESSION['usu'];
    /* $psw = $_SESSION['psw']; */
    $cod = intval($_SESSION['cod']);
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die("Fatal Error");


?>
    <!DOCTYPE html>
        <html>
        <head>
            <style>
                .circulos {
                    display: flex;
                }
                .circulo {
                    width: 100px;       
                    height: 100px;      
                    
                    border-radius: 50%; 
                }
            </style>
        </head>
    <?php
    if ($_SESSION["solucion"] == $_SESSION["respuesta"]) {
        $query = "INSERT INTO jugadas (codigousu, acierto) VALUES ($cod, 1)";
    ?>
        
        <body>
            <h1>SIMÓN</h1>
            <h2><?php echo $_SESSION['usu']; ?> enhorabuena, has acertado</h2>
            <div class="circulos">
                <?php pintar_circulos($_SESSION["solucion"][0],$_SESSION["solucion"][1],$_SESSION["solucion"][2],$_SESSION["solucion"][3]);?>
            </div>
            <a href="index.php">Acertaste, nueva ronda</a>
            <a href="estadistica.php?usuario=<?php echo $_SESSION['usu']; ?>">Estadistica</a>
        </body>
        </html>
        <?php
    } else {
        $query = "INSERT INTO jugadas (codigousu,acierto) VALUES ($cod, 0)";
        ?>
        <body>
            <h1>SIMÓN</h1>
            <h2><?php echo $_SESSION['usu']; ?>, lo sentimos has fallado</h2>
            <h3>LA COMBINACIÓN CORRECTA ERA:</h3>
            <div class="circulos">
                
                <?php pintar_circulos($_SESSION["solucion"][0],$_SESSION["solucion"][1],$_SESSION["solucion"][2],$_SESSION["solucion"][3]);?>
            </div>
            <h3>TU RESPUESTA:</h3>
            <div class="circulos">
                
                <?php pintar_circulos($_SESSION["respuesta"][0],$_SESSION["respuesta"][1],$_SESSION["respuesta"][2],$_SESSION["respuesta"][3]);?>
            </div>
            <a href="index.php">Fallaste, nueva ronda</a>
            <a href="estadistica.php?usuario=<?php echo $_SESSION['usu']; ?>">Estadistica</a>
        </body>
        </html>
        <?php
    }
    $result = $connection->query($query);
    if (!$result) die("Fatal Error");
    $connection->close();
     session_destroy();
    
?>