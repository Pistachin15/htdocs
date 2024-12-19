<?php
    $usuario = $_POST['usu'];
    $contra = $_POST['psw'];
    require_once 'login.php';
    $connection = new mysqli($hn, $un, $pw, $db);
    if ($connection->connect_error) die("Fatal Error");
    $query = "SELECT USU,CONTRA FROM usuarios WHERE USU = '$usuario' AND CONTRA = '$contra' ";
    $result = $connection->query($query);
    if (!$result) die("Fatal Error");
    $rows = $result->num_rows;
    if ($rows!=0) {
        echo "LOGUEADO CORRECTAMENTE";
    } else {
        echo "<a href='acceso.php'>NO EXISTE EL USUARIO Y/O CONTRASEÑA, VUELVA A INTENTARLO</a>";
    }

    $connection->close();
?>