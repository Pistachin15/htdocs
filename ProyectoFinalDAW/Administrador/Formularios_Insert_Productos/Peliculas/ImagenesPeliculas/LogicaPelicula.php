<?php
require_once '../login.php'; // conexión: $hn, $un, $pw, $db

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Error en la conexión.");
}

$mensaje = "";
$exito = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = $_POST['titulo'];
    $tipo = 'película'; // fijo
    $descripcion = $_POST['descripcion'] ?? null;
    $stock = intval($_POST['stock']);
    $precio_compra = floatval($_POST['precio_compra']);
    $precio_alquiler = floatval($_POST['precio_alquiler']);

    $imagenRuta = null;

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreTmp = $_FILES['imagen']['tmp_name'];
        $nombreArchivo = basename($_FILES['imagen']['name']);
        $directorioDestino = 'imagenes/'; // debe estar al mismo nivel
        $nombreFinal = uniqid() . '_' . $nombreArchivo;
        $rutaFinal = $directorioDestino . $nombreFinal;

        if (move_uploaded_file($nombreTmp, $rutaFinal)) {
            $imagenRuta = $rutaFinal;
        } else {
            $mensaje = "Error al guardar la imagen.";
        }
    }

    if ($mensaje === "") {
        $stmt = $conn->prepare("INSERT INTO productos (titulo, tipo, descripcion, stock, precio_compra, precio_alquiler, imagen)
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssidds", $titulo, $tipo, $descripcion, $stock, $precio_compra, $precio_alquiler, $imagenRuta);

        if ($stmt->execute()) {
            $mensaje = "✅ La película se ha insertado correctamente.";
            $exito = true;
        } else {
            $mensaje = "❌ Error al insertar: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!-- Resultado -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado de inserción</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert <?= $exito ? 'alert-success' : 'alert-danger' ?> text-center" role="alert">
                    <?= htmlspecialchars($mensaje) ?>
                </div>
                <div class="text-center">
                    <a href="formulario_pelicula.html" class="btn btn-primary">Volver al formulario</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
