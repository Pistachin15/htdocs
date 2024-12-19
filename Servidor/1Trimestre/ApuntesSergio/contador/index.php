<?php
session_start();
if (isset($_POST["input"])) {
    switch ($_POST["input"]) {
        case "+":
            $_SESSION["num"]++;
        break;
        case "-":
            $_SESSION["num"]--;
        break;
    }
} else {
    $_SESSION["num"] = 0;
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
    <h1>CONTADOR</h1>
    <form action="#" method="post">
        <input type="submit" value="-" name="input">
        <input type="text" id="num" name="num" value="<?php echo $_SESSION["num"]; ?>" readonly>
        <input type="submit" value="+" name="input">
    </form>
    <form action="fin.php" method="post">
        <input type="submit" value="Cerrar" name="input">
    </form>
</body>
</html>