<?php
$tipo = $_GET['tipo'] ?? '';
$mensaje = match($tipo) {
    'compra' => '✅ ¡Gracias por tu compra! Tu pedido ha sido procesado correctamente.',
    'alquiler' => '✅ ¡Gracias por alquilar con nosotros! Disfruta tu contenido.',
    default => '✅ ¡Gracias! Operación completada.'
};
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Éxito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="alert alert-success">
        <?= $mensaje ?>
    </div>
    <a href="../Index.php" class="btn btn-primary">Volver al inicio</a>
</div>
</body>
</html>
