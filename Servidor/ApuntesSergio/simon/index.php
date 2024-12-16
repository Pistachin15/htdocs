<?php

session_start();
require_once 'login.php';
if (isset($_POST['usu'])) {
    $usu = $_POST['usu'];
    $psw = $_POST['psw'];
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die("Fatal Error");
    $query = "SELECT Codigo,Nombre,Clave FROM usuarios WHERE Nombre = '$usu' AND Clave = '$psw' ";
    $result = $connection->query($query);
    if (!$result) die("Fatal Error");
    $rows = $result->num_rows;
    if ($rows!=0) {
        $_SESSION['usu'] = $_POST['usu'];
        /* $_SESSION['psw'] = $_POST['psw']; */
        $result->data_seek(0);
        $_SESSION['cod'] = htmlspecialchars($result->fetch_assoc()['Codigo']);
        echo "LOGUEADO CORRECTAMENTE";
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