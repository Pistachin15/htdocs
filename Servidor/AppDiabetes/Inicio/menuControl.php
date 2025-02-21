<?php
session_start();

if (!isset($_SESSION['nombreUsu'])) {
    header('Location: ../login.php');
    exit();
}

$nombreUsu = $_SESSION['nombreUsu'];

require_once '../login.php'; // Archivo con credenciales de conexión a la base de datos
$conn = new mysqli($hn, $un, $pw, $db);

if ($conn->connect_error) die("Fatal Error");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menú Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="bg-white p-4 rounded shadow text-center">
        <h5 class="fw-bold text-danger"><?php echo 'Bienvenid@ '.$nombreUsu ?></h5>
        <a href="../ControlGlucosa/InsertarControlGlucosa.php" class="btn btn-secondary w-100 mb-3">Insertar Control de Glucosa</a>
        <a href="../InsertRegistro/InsertarDatos.php" class="btn btn-secondary w-100 mb-3">Insertar Datos</a>
        <a href="../UpdateRegistro/MenuUpdate.html" class="btn btn-secondary w-100 mb-3">Modificar Datos</a>
        <a href="../DeleteRegistro/MenuDelete.html" class="btn btn-secondary w-100 mb-3">Borrar Datos</a>
        <a href="../MostrarTablaDatos.php" class="btn btn-secondary w-100 mb-3">Ver Datos</a>
        <a href="pagina5.html" class="btn btn-secondary w-100 mb-3">Ver Estadísticas</a>
    </div>
</body>
</html>
