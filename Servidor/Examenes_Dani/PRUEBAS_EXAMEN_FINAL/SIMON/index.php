<?php
//^Iniciamos una sesión ya que varios de los datos que utilicemos se van a reutilizar
session_start();
require_once 'login.php';
if (isset($_POST['usu'])) {
    //^comprobamos que el usuario ha sido establecido y metemos tanto a este 
    //^como a la contraseña dentro de variables
    $usu = $_POST['usu'];
    $psw = $_POST['psw'];
    //^A continuación iniciamos la sesión 
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die("Fatal Error");
    //^Hacemos la consulta select donde buscaremos el codigo el nombre y la clave del usuario
    $query = "SELECT Codigo,Nombre,Clave FROM usuarios WHERE Nombre = '$usu' AND Clave = '$psw' ";
    $result = $connection->query($query);
    //^Si el resultado falla nos da error fatal
    if (!$result) die("Fatal Error");
    //^A continuación comprpbamos que las filas en la tabla sean distintas de cero
    $rows = $result->num_rows;
    if ($rows!=0) {
        //^Guardamos al usuario recogido por el formulario en una sesión para su posterior uso
        $_SESSION['usu'] = $_POST['usu'];
        /* $_SESSION['psw'] = $_POST['psw']; */
        //&Data_Seek sirve para reiniciar el puntero
        //&y Fetch_assoc.Básicamente, convierte cada fila en un array donde los nombres de las columnas son las claves del array.
        $result->data_seek(0);
        //^Guardamos en una sesión el código
        $_SESSION['cod'] = htmlspecialchars($result->fetch_assoc()['Codigo']);
        echo "LOGUEADO CORRECTAMENTE";
        //^Cerramos conexión y enviamos al siguiente archivo
        $connection->close();
        echo<<<_END
            <meta http-equiv="refresh" content="0;URL='jugar.php'" />
        _END;
    } else {
        session_destroy();
        echo "<a href='index.php'>NO EXISTE EL USUARIO Y/O CONTRASEÑA, VUELVA A INTENTARLO</a>";
    }

}

?>

<!-- Este es el formulario en HTML, en el recogemos el usuario y la contraseña 
     en el form el action tiene que ser una almohadilla porque el php está en el 
     mismo archivo.-->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>VAMOS A JUGAR AL SIMÓN!!!!</h1>
    <form action="#" method="post">
        <label for="usu">Usuario: </label>
        <input type="text" id="usu" name="usu" required><br>
        <label for="usu">Contraseña: </label>
        <input type="password" id="psw" name="psw" required><br>
        <!-- <a href="registro.php">Registrese</a><br>  -->
        <input type="submit" value="Entrar" name="submit">
    </form>
</body>

</html>