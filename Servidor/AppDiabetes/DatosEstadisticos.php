<?php
session_start();
require_once 'login.php';

// Conectar a la base de datos
$conn = new mysqli($hn, $un, $pw, $db, $conn);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id_usu = $_SESSION['id_usu']; // Obtener el ID del usuario en sesión

// Consulta para estadísticas de glucosa por usuario
$sql_glucosa = "SELECT 
    AVG(gl_1h) AS promedio_glucosa_1h,
    MIN(gl_1h) AS minimo_glucosa_1h,
    MAX(gl_1h) AS maximo_glucosa_1h,
    AVG(gl_2h) AS promedio_glucosa_2h,
    MIN(gl_2h) AS minimo_glucosa_2h,
    MAX(gl_2h) AS maximo_glucosa_2h
FROM COMIDA WHERE id_usu = '$id_usu'";
$result_glucosa = $conn->query($sql_glucosa);
$glucosa = $result_glucosa->fetch_assoc();

// Consulta para frecuencia de hiperglucemia por usuario
$sql_hiper = "SELECT COUNT(*) AS total_hiperglucemias 
FROM HIPERGLUCEMIA WHERE id_usu = '$id_usu'";
$result_hiper = $conn->query($sql_hiper);
$hiperglucemia = $result_hiper->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Estadísticas de Diabetes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">
    <div class="container-sm mt-5">
        <div class="text-center">
            <h2 class="text-primary fw-bold">Estadísticas de Glucosa</h2>
        </div>

        <!-- Tarjeta de Estadísticas de Glucosa -->
        <div class="card shadow-sm p-4 mt-4">
            <canvas id="glucosaChart"></canvas>
        </div>

        <!-- Tarjeta de Hiperglucemia -->
        <div class="card shadow-sm p-4 mt-4">
            <h2 class="text-center text-danger fw-bold">Frecuencia de Hiperglucemia</h2>
            <canvas id="hiperglucemiaChart"></canvas>
        </div>

        <!-- Botón de Volver -->
        <div class="text-center mt-4">
            <a href="Inicio/menuControl.php" class="btn btn-secondary btn-lg">Volver</a>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('glucosaChart').getContext('2d');
        var glucosaChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Promedio', 'Mínimo', 'Máximo'],
                datasets: [
                    {
                        label: '1 Hora',
                        data: [<?= $glucosa['promedio_glucosa_1h'] ?>, <?= $glucosa['minimo_glucosa_1h'] ?>, <?= $glucosa['maximo_glucosa_1h'] ?>],
                        backgroundColor: 'rgba(75, 192, 192, 0.7)'
                    },
                    {
                        label: '2 Horas',
                        data: [<?= $glucosa['promedio_glucosa_2h'] ?>, <?= $glucosa['minimo_glucosa_2h'] ?>, <?= $glucosa['maximo_glucosa_2h'] ?>],
                        backgroundColor: 'rgba(255, 99, 132, 0.7)'
                    }
                ]
            },
            options: {
                responsive: true,
                animation: false,  // Desactivar animación
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctx2 = document.getElementById('hiperglucemiaChart').getContext('2d');
        var hiperglucemiaChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Episodios de Hiperglucemia', 'Normal'],
                datasets: [{
                    data: [<?= $hiperglucemia['total_hiperglucemias'] ?>, Math.max(0, 100 - <?= $hiperglucemia['total_hiperglucemias'] ?>)],
                    backgroundColor: ['rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)']
                }]
            },
            options: {
                responsive: true,
                animation: false,  // Desactivar animación
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
