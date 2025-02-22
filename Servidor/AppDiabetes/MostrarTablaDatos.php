<?php
session_start();
require_once 'login.php'; // Archivo con credenciales de conexión a la base de datos

// Verificar si el usuario está logeado
if (!isset($_SESSION['id_usu'])) {
    die("Acceso denegado. Inicia sesión primero.");
}

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal Error");

// Obtener el id del usuario logeado
$id_usu = $_SESSION['id_usu'];

// Consulta SQL filtrada por el usuario logeado
$sql = "SELECT c.fecha, c.deporte, c.lenta, cm.tipo_comida, cm.gl_1h, cm.gl_2h, cm.raciones, cm.insulina,
               hipo.glucosa AS hipo_glucosa, hipo.hora AS hipo_hora, 
               hiper.glucosa AS hiper_glucosa, hiper.hora AS hiper_hora, hiper.correccion AS hiper_correccion
        FROM CONTROL_GLUCOSA c
        LEFT JOIN COMIDA cm ON c.fecha = cm.fecha AND c.id_usu = cm.id_usu
        LEFT JOIN HIPOGLUCEMIA hipo ON cm.fecha = hipo.fecha AND cm.tipo_comida = hipo.tipo_comida AND cm.id_usu = hipo.id_usu
        LEFT JOIN HIPERGLUCEMIA hiper ON cm.fecha = hiper.fecha AND cm.tipo_comida = hiper.tipo_comida AND cm.id_usu = hiper.id_usu
        WHERE c.id_usu = ?
        ORDER BY c.fecha ASC";

// Preparar la consulta
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usu);
$stmt->execute();
$result = $stmt->get_result();

// Estructurar los datos por día y tipo de comida
$data = [];
$tipo_comidas = [];
while ($row = $result->fetch_assoc()) {
    $data[$row['fecha']][$row['tipo_comida']] = $row;
    if (!in_array($row['tipo_comida'], $tipo_comidas)) {
        $tipo_comidas[] = $row['tipo_comida'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historial de Datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column vh-100">

    <div class="container-fluid p-4 d-flex flex-column flex-grow-1">
        <h2 class="text-center mb-4">Historial de Datos</h2>

        <div class="table-responsive flex-grow-1">
            <table class="table table-bordered table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <th rowspan="2" class="align-middle">Día</th>
                        <th rowspan="2" class="align-middle">Deporte</th>
                        <th rowspan="2" class="align-middle">Insulina Lenta</th>
                        <?php foreach ($tipo_comidas as $tipo): ?>
                            <th colspan="9"><?= htmlspecialchars($tipo) ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <?php foreach ($tipo_comidas as $tipo): ?>
                            <th>Glucosa 1h</th>
                            <th>Glucosa 2h</th>
                            <th>Raciones</th>
                            <th>Insulina</th>
                            <th>Hipo Glucosa</th>
                            <th>Hipo Hora</th>
                            <th>Hiper Glucosa</th>
                            <th>Hiper Hora</th>
                            <th>Corrección</th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $fecha => $rows): ?>
                        <tr>
                            <td><?= htmlspecialchars($fecha) ?></td>
                            <td><?= htmlspecialchars($rows[array_key_first($rows)]["deporte"] ?? '') ?></td>
                            <td><?= htmlspecialchars($rows[array_key_first($rows)]["lenta"] ?? '') ?></td>
                            <?php foreach ($tipo_comidas as $tipo): ?>
                                <td><?= htmlspecialchars($rows[$tipo]["gl_1h"] ?? '') ?></td>
                                <td><?= htmlspecialchars($rows[$tipo]["gl_2h"] ?? '') ?></td>
                                <td><?= htmlspecialchars($rows[$tipo]["raciones"] ?? '') ?></td>
                                <td><?= htmlspecialchars($rows[$tipo]["insulina"] ?? '') ?></td>
                                <td><?= htmlspecialchars($rows[$tipo]["hipo_glucosa"] ?? '') ?></td>
                                <td><?= htmlspecialchars($rows[$tipo]["hipo_hora"] ?? '') ?></td>
                                <td><?= htmlspecialchars($rows[$tipo]["hiper_glucosa"] ?? '') ?></td>
                                <td><?= htmlspecialchars($rows[$tipo]["hiper_hora"] ?? '') ?></td>
                                <td><?= htmlspecialchars($rows[$tipo]["hiper_correccion"] ?? '') ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-3">
            <a href="Inicio/menuControl.php" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php 
$stmt->close();
$conn->close();
?>
