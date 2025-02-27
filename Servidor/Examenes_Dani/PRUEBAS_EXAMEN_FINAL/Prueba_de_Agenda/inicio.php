<?php
    //^Inciamos la sesión
    session_start();
    //^Se comprueba que se ha pulsado el botón INCREMENTAR
    if (isset($_POST['input'])) {
        //^Se comprueba si el contador y el botón  están por debajo de cinco
        if ($_POST['input'] == "INCREMENTAR" && $_SESSION['contador']<4) {
            $_SESSION['contador']++;
            //^Y si es mayor de cinco 
        } else if ($_SESSION['contador']>=4) {
            //^Al ser posible grabar menos de cinco usuarios nos envía a agenda
            echo<<<_END
                <meta http-equiv="refresh" content="0;URL='agenda.php'" />
            _END;
        } else {
            //^Y si llegamos a cinco que es el máximo nos envía a agenda también
            echo<<<_END
                <meta http-equiv="refresh" content="0;URL='agenda.php'" />
            _END;
        }
    } else {
        //^En caso de que no se haya pulsado incrementar inicializamos la sesión en un solo usuario
        $_SESSION['contador'] = 0;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>AGENDA</h1>
    <div style="border: 4px double; width:40%;"> 
        <!-- Aqui reutilazmos la SESSION que habiamos guardado para ver el nombre del usuario -->
        <p>Hola <?php echo  $_SESSION['usu'];?>, cuantos contactos deseas grabar?</p>
        <p>Puedes grabar entre 1 y 5. Por cada pulsación en INCREMENTAR grabarás un usuario más.</p>
        <p>Cuando el número sea el deseado pulsa GRABAR</p>
    </div>
    <div>
     <!--    Hacemos un for que sirva para que cada vez que pulsemos en incrementar 
        Aparezca una nueva imagen -->
        <?php 
            for ($i=0;$i<=$_SESSION['contador']; $i++) {
                echo "<img src='img/OIP$i.jfif' style='border: 4px double; width:5%;'>";
            }
        ?>
    </div>
    <form method="post" action="#">
        //!Botón para incrementar los contactos
    <input type="submit" value="INCREMENTAR" name="input">
        //!Botón para grabarlos 
    <input type="submit" value="GRABAR" name="input">
    </form>
</body>
</html>