<?php
session_start();
if( isset($_POST['boton'])){
    if($_POST['boton'] == 'Sumar'){
        $_SESSION['contador']++;

    }

    else if($_POST['boton'] == 'Restar'){
        $_SESSION['contador']--;
    }

}



else{
    $_SESSION['contador'] = 0;


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador</title>
</head>
<body>
    <h1>CONTADOR</h1>
    <article>
        <form action="Contador.php" method="post" class="mi-formulario">
            <input type="submit" value="Restar" name=boton>
            <label for="num1"><?php echo $_SESSION['contador']?></label>
            <input type="submit" value="Sumar" name=boton>
            <input type="submit" value="Cerrar" name=boton>

        </form>
    </article>

    
</body>
</html>


<?php
     if($_POST['boton'] == 'Cerrar'){
    session_destroy();
    header("Location: Contador.php");
}

?>
