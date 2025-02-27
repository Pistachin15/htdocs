<?php

//^Iniciamos la sesión 
    session_start();
//^Hacemos la conexion a la base de datos
    require_once 'conexion.php';

    //^Se comprueba que se haya introducido usuario
    if (isset($_POST['usu'])) {
        //^Iniciamos las variables
        $usu = $_POST['usu'];
        $psw = $_POST['psw'];
        $connection = new mysqli($hn, $un, $pw, $db);
        //^En caso de que haya un error se cierra la conexión 
        if ($connection->connect_error) die("Fatal Error");
        //^Hacemos un select para comprobar si en usuarios existe el Nombre y la Clave
        $query = "SELECT Codigo,Nombre FROM usuarios WHERE Nombre = '$usu' AND Clave = '$psw' ";
        //^Lo guardamos en una variable llamada result 
        $result = $connection->query($query);
        //^Si el resultado nos da error la conexión se cierra 
        if (!$result) die("Fatal Error");
        //^Se leen las dilas disponibles
        $rows = $result->num_rows;
        //^Y en caso q sean igual o distinta de cero obtenemos 
        //^un logueo correcto
        if ($rows!=0) {
            //^Guardamos el POST dentro de una SESSION para usarlo en otros archivos 
            //^En el futuro
            $_SESSION['usu'] = $_POST['usu'];
            $result->data_seek(0);
            $_SESSION['cod'] = htmlspecialchars($result->fetch_assoc()['Codigo']);
            echo "LOGUEADO CORRECTAMENTE";
            //^Una vez logueados cerramos sesión
            $connection->close();
            //^Nos envía al siguiente archivo
            echo<<<_END
                <meta http-equiv="refresh" content="0;URL='inicio.php'" />
            _END;
        } else { 
            //^En caso de que al leer las filas no se encuentre ningún usuario nos vuelve a enviar al inicio
            //^de sesión
            session_destroy();
            echo "<a href='index.php'>NO EXISTE EL USUARIO Y/O CONTRASEÑA, VUELVA A INTENTARLO</a>";
        }
    
    }
?>
<!-- Se realiza el html con el formulario q vamos a utilizar -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>AGENDA DE CONTACTOS</h1>
<!--     Utilizamos el motodo post y ademas dejamos la almohadilla  -->
    <form action="#" method="post" >
        
        <label for="usu">Usuario:</label>
        <input type="text" id="usu" name="usu" required>
        <label for="psw">Contraseña:</label>
        <input type="password" id="psw" name="psw" required>
        <!-- Ponemos el botón que es tipo submit -->
        <input type="submit" value="Entrar">
        
    </form>
</body>
</html>