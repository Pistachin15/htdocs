<?php
    session_start();
    require_once "pintar-circulos.php";
    

    if (isset($_SESSION["res1"])) {
        switch (true) {
            case $_SESSION["res1"] == "black":
                $_SESSION["res1"] = $_POST["tempColor"];
            break;
            case $_SESSION["res2"] == "black":
                $_SESSION["res2"] = $_POST["tempColor"];
            break;
            case $_SESSION["res3"] == "black":
                $_SESSION["res3"] = $_POST["tempColor"];
            break;
            case $_SESSION["res4"] == "black":
                $_SESSION["res4"] = $_POST["tempColor"];
                
                $_SESSION["respuesta"] = [$_SESSION["res1"],$_SESSION["res2"],$_SESSION["res3"],$_SESSION["res4"]];
                
                echo<<<_END
                     <meta http-equiv="refresh" content="0;url=comprobar.php">
                _END;
            break;
            
        }
    } else {
        $_SESSION["res1"] = "black";
        $_SESSION["res2"] = "black";
        $_SESSION["res3"] = "black";
        $_SESSION["res4"] = "black";
    }
    
    

    


    
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<body>
    <h1>SIMÓN</h1>
    <h2><?php echo $_SESSION['usu']; ?> pulsa los botones en el orden correspondiente</h2>
    <div class="circulos">
        <?php  $_SESSION["respuesta"] = pintar_circulos($_SESSION["res1"],$_SESSION["res2"],$_SESSION["res3"],$_SESSION["res4"]); ?>
    </div>
    <form action="#" method="post">
        <input type="submit" value="red" name="tempColor">
        <input type="submit" value="green" name="tempColor">
        <input type="submit" value="blue" name="tempColor">
        <input type="submit" value="yellow" name="tempColor">
    </form>
    
    
</body>
</html>