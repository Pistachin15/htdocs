<?php
session_start();
require_once '../../../login.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    die("Acceso denegado.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = (int)$_POST['id'];

    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para obtener el tipo antes de borrar (para redirigir después)
    $stmt = $conn->prepare("SELECT tipo FROM productos WHERE id_producto = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($tipo);
    if ($stmt->fetch()) {
        $stmt->close();

        // Luego borramos
        $del = $conn->prepare("DELETE FROM productos WHERE id_producto = ?");
        $del->bind_param("i", $id);
        $del->execute();
        $del->close();

        // Redirigir según el tipo
        if ($tipo === 'videojuego') {
            header("Location: ../../../Catalogos/CatalogoVideojuego/catalogo_videojuegos.php");
        } elseif ($tipo === 'película') {
            header("Location: ../../../Catalogos/CatalogoPelicula/catalogo_peliculas.php");
        } else {
            echo "Tipo de producto no reconocido.";
        }
    } else {
        echo "Producto no encontrado.";
    }

    $conn->close();
} else {
    echo "Solicitud no válida.";
}
?>
