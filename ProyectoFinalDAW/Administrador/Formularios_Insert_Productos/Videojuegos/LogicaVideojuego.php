<?php
require_once '../../../login.php'; // conexión: $hn, $un, $pw, $db

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die("Error en la conexión.");
}

// Verificar que se haya enviado el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recoger los datos del formulario
    $titulo = $_POST['titulo'];
    $tipo = 'videojuego'; // fijo
    $descripcion = $_POST['descripcion'] ?? null;
    $stock = intval($_POST['stock']);
    $precio_compra = floatval($_POST['precio_compra']);
    $precio_alquiler = floatval($_POST['precio_alquiler']);

    // Procesar la imagen si se subió
    $imagenRuta = null;

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreTmp = $_FILES['imagen']['tmp_name'];
        $nombreArchivo = basename($_FILES['imagen']['name']);
        $directorioDestino = 'imagenesVideojuegos'; // Asegúrate de que exista y tenga permisos
        $rutaFinal = $directorioDestino . uniqid() . '_' . $nombreArchivo;

        // Mover archivo subido
        if (move_uploaded_file($nombreTmp, $rutaFinal)) {
            $imagenRuta = $rutaFinal;
        } else {
            die("Error al guardar la imagen.");
        }
    }

    // Preparar inserción
    $stmt = $conn->prepare("INSERT INTO productos (titulo, tipo, descripcion, stock, precio_compra, precio_alquiler, imagen)
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssidds", $titulo, $tipo, $descripcion, $stock, $precio_compra, $precio_alquiler, $imagenRuta);

    if ($stmt->execute()) {
        echo "<p>Videojuego agregado correctamente.</p>";
        echo "<a href='formulario_videojuego.html'>Volver al formulario</a>";
    } else {
        die("Error al insertar: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>
