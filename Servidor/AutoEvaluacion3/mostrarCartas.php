<?php
session_start();
$nombreUsu = $_SESSION['nombreUsu'] ?? 'Invitado';
echo "<h1>Bienvenid@, $nombreUsu</h1>";

if (!isset($_SESSION['arrayCartas'])) {
    $combinacion = [2, 2, 3, 3, 5, 5];
    shuffle($combinacion);  
    $_SESSION['arrayCartas'] = $combinacion; 
    $_SESSION['contador'] = 0; 
}

print_r($_SESSION['arrayCartas']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    
</body>
</html>
