<?php
session_start();
require_once 'login.php'; // Archivo con credenciales de conexión a la base de datos

// Crear conexión
$conn = new mysqli($hn, $un, $pw, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener todas las tablas de la base de datos
$tables_result = $conn->query("SHOW TABLES");
$all_data = [];
$columns = [];

while ($table = $tables_result->fetch_array()) {
    $table_name = $table[0];
    
    // Obtener los datos de cada tabla
    $sql = "SELECT * FROM $table_name";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($field = $result->fetch_field()) {
            if (!in_array($field->name, $columns)) {
                $columns[] = $field->name;
            }
        }
        
        while ($row = $result->fetch_assoc()) {
            $row["tabla"] = $table_name;
            $all_data[] = $row;
        }
    }
}

// Mostrar datos en una tabla HTML
echo "<table border='1'>";
echo "<tr><th>Tabla</th>";
foreach ($columns as $column) {
    echo "<th>$column</th>";
}
echo "</tr>";

foreach ($all_data as $row) {
    echo "<tr>";
    echo "<td>" . $row["tabla"] . "</td>";
    foreach ($columns as $column) {
        echo "<td>" . ($row[$column] ?? '') . "</td>";
    }
    echo "</tr>";
}

echo "</table>";

// Cerrar conexión
$conn->close();
?>
