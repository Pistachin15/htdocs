<?php
require_once '../login/login.php'; // Archivo con credenciales de conexión a la base de datos
$conn = new mysqli($hn, $un, $pw, $db, 3307 );

if ($conn->connect_error) die("Fatal Error");

?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menú Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #007bff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .menu-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .menu-container h5 {
            font-weight: bold;
            color: red;
        }
        .btn-custom {
            width: 100%;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="menu-container">
        <h5><?php   ?></h5>
        <button class="btn btn-secondary btn-custom">Nuevo Registro</button>
        <button class="btn btn-secondary btn-custom">Modificar Registros</button>
        <button class="btn btn-secondary btn-custom">Eliminar Registros</button>
        <button class="btn btn-secondary btn-custom">Ver Registros</button>
        <button class="btn btn-secondary btn-custom">Revisar estadísticas</button>
    </div>
</body>
</html>

