<?php
require_once '../../../login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    mostrarError("Error en la conexión a la base de datos.");
    exit();
}

function mostrarError($mensaje) {
    echo "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Error</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>
    <body class='bg-light'>
        <div class='container mt-5'>
            <div class='alert alert-danger'>$mensaje</div>
            <a href='formularioInsertVideojuego.php' class='btn btn-secondary'>Volver</a>
        </div>
    </body>
    </html>
    ";
}

$titulo = trim($_POST['titulo']);
$descripcion = trim($_POST['descripcion']);
$stock = intval($_POST['stock']);
$precio_compra = floatval($_POST['precio_compra']);
$precio_alquiler = floatval($_POST['precio_alquiler']);
$tipo = 'videojuego';

if ($stock < 0 || $precio_compra < 0 || $precio_alquiler < 0 || empty($titulo) || empty($descripcion)) {
    mostrarError("Datos inválidos o campos vacíos.");
    exit();
}

// Verificar si el videojuego ya existe
$stmt = $conn->prepare("SELECT id_producto FROM productos WHERE titulo = ? AND tipo = ?");
$stmt->bind_param("ss", $titulo, $tipo);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    mostrarError("El videojuego ya existe en la base de datos.");
    exit();
}
$stmt->close();

$imagenNombre = null;
$carpetaDestino = "imagenesVideojuegos/";

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
    $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $ext = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $extensiones_permitidas)) {
        mostrarError("Formato de imagen no permitido. Usa jpg, jpeg, png, gif o webp.");
        exit();
    }

    if (!is_dir($carpetaDestino)) {
        mkdir($carpetaDestino, 0777, true);
    }

    $nombreOriginal = pathinfo($_FILES['imagen']['name'], PATHINFO_FILENAME);
    $nombreSanitizado = preg_replace('/[^a-zA-Z0-9_-]/', '', strtolower($nombreOriginal));
    $imagenNombre = $carpetaDestino . uniqid('', true) . "_" . $nombreSanitizado . "." . $ext;


    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $imagenNombre)) {
        mostrarError("Error al subir la imagen al servidor.");
        exit();
    }
} else {
    mostrarError("No se seleccionó ninguna imagen válida.");
    exit();
}

// Insertar en la base de datos
$stmt = $conn->prepare("INSERT INTO productos (titulo, tipo, descripcion, stock, precio_compra, precio_alquiler, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssidds", $titulo, $tipo, $descripcion, $stock, $precio_compra, $precio_alquiler, $imagenNombre);

if ($stmt->execute()) {
    echo "<script>window.location.href='formularioInsertVideojuego.php?success=1';</script>";
} else {
    mostrarError("Error al insertar el videojuego en la base de datos.");
}

$stmt->close();
$conn->close();
?>
