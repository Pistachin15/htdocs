<?php
//^Iniciamos la SESSION
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Agenda</h1>
    <!-- De nuevo recuperamos el nombre del usuario -->
    <h2>Hola <?php echo  $_SESSION['usu'];?></h2>
    <!-- Como el fomulario va a ser llevado a otra app la nombramos en la acción-->    
     <form method="post" action="grabado.php">
        <!-- Mostramos el formulario con un for que nos cuente el número  de veces que pulsamos INCREMENTAR -->
        <?php 
            for ($i=1;$i<=$_SESSION['contador']+1; $i++) {
                //&La i se trata del número de veces que pulsamos incrementar
                echo "<fieldset style='border: 4px double; display:inline;'><p>CONTACTO$i</p>";
                echo<<<_END
                    <label for='nombre$i'>Nombre$i </label>
                    <input type='text' id='nombre$i' name='nombre$i' required>
                    <br>
                    <label for='email$i'>Email$i </label>
                    <input type='email' id='email$i' name='email$i' required>
                    <br>
                    <label for='telefono$i'>Telefono$i </label>
                    <input type='tel' id='telefono$i' name='telefono$i' required></fieldset>
                _END;
            }
        ?>
        <br>
        <input type="submit" value="Grabar">
    </form>
</body>
</html>