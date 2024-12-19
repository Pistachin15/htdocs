<?php
session_name("Sesiones_1_13");  
session_start();

if (!isset($_SESSION['x']) || !isset($_SESSION['y'])) {
    $_SESSION['x'] = $_SESSION['y'] = 0;
}

function recoge($var) {
    $tmp = (isset($_REQUEST[$var])) 
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8")) 
        : "";
    return $tmp;
}

$accion = recoge("accion");
$accionOK = true;

if ($accion != "centro" && $accion != "izquierda" && $accion != "derecha" 
   && $accion != "arriba" && $accion != "abajo") {
    header("Location: boton.php");
    exit;
} else {
    $accionOK = true;
}

if ($accionOK) {
    if ($accion == "centro") {
        $_SESSION["x"] = $_SESSION["y"] = 0;
    } 
    elseif ($accion == "izquierda") {
        $_SESSION["x"] -= 20; 
    } 
    elseif ($accion == "derecha") {
        $_SESSION["x"] += 20; 
    } 
    elseif ($accion == "arriba") {
        $_SESSION["y"] -= 20; 
    } 
    elseif ($accion == "abajo") {
        $_SESSION["y"] += 20; 
    }

    if ($_SESSION["x"] > 200) {
        $_SESSION["x"] = -200;
    } elseif ($_SESSION["x"] < -200) {
        $_SESSION["x"] = 200;
    }
    if ($_SESSION["y"] > 200) {
        $_SESSION["y"] = -200;
    } elseif ($_SESSION["y"] < -200) {
        $_SESSION["y"] = 200;
    }

    header("Location: boton.php");
    exit;
}
?>
