<?php
require_once '../../../login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Error en la conexión.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = trim($_POST['titulo']);
    $tipo = 'película';
    $descripcion = trim($_POST['descripcion'] ?? '');
    $stock = intval($_POST['stock']);
    $precio_compra = floatval($_POST['precio_compra']);
    $precio_alquiler = floatval($_POST['precio_alquiler']);

    if (empty($titulo) || $stock < 0 || $precio_compra < 0 || $precio_alquiler < 0) {
        header("Location: formularioInsertPelicula.php?mensaje=" . urlencode("Datos inválidos, revisa los campos.") . "&tipo=error");
        exit();
    }

    // Validar imagen obligatoria
    if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
        header("Location: formularioInsertPelicula.php?mensaje=" . urlencode("Debes subir una imagen.") . "&tipo=error");
        exit();
    }

    // Validar extensión de imagen
    $nombreArchivo = basename($_FILES['imagen']['name']);
    $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
    $extensiones_validas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (!in_array($extension, $extensiones_validas)) {
        header("Location: formularioInsertPelicula.php?mensaje=" . urlencode("Extensión de imagen no válida. Solo se permiten JPG, PNG, GIF, WEBP.") . "&tipo=error");
        exit();
    }

    // Verificar duplicados
    $check = $conn->prepare("SELECT COUNT(*) FROM productos WHERE titulo = ?");
    $check->bind_param("s", $titulo);
    $check->execute();
    $check->bind_result($count);
    $check->fetch();
    $check->close();

    if ($count > 0) {
        header("Location: formularioInsertPelicula.php?mensaje=" . urlencode("Ya existe una película con ese título.") . "&tipo=error");
        exit();
    }

    // Guardar imagen
    $nombreTmp = $_FILES['imagen']['tmp_name'];
    $directorioDestino = 'imagenesVideojuegos/';
    if (!is_dir($directorioDestino)) {
        mkdir($directorioDestino, 0755, true);
    }
    $rutaFinal = $directorioDestino . uniqid() . '_' . $nombreArchivo;

    if (move_uploaded_file($nombreTmp, $rutaFinal)) {
        $imagenRuta = $rutaFinal;
    } else {
        header("Location: formularioInsertPelicula.php?mensaje=" . urlencode("Error al guardar la imagen.") . "&tipo=error");
        exit();
    }

    // Insertar en la base de datos
    $stmt = $conn->prepare("INSERT INTO productos (titulo, tipo, descripcion, stock, precio_compra, precio_alquiler, imagen)
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssidds", $titulo, $tipo, $descripcion, $stock, $precio_compra, $precio_alquiler, $imagenRuta);

    if ($stmt->execute()) {
        header("Location: formularioInsertPelicula.php?mensaje=" . urlencode("Película agregada correctamente.") . "&tipo=success");
    } else {
        header("Location: formularioInsertPelicula.php?mensaje=" . urlencode("Error al insertar: " . $stmt->error) . "&tipo=error");
    }

    $stmt->close();
}

$conn->close();
