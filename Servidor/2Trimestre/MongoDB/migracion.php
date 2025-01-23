<?php
require 'C:\xampp\vendor\autoload.php';
$mysqli = new mysqli("localhost", "root", "", "mi_base_de_datos", 3307);
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$mongoDB = $mongoClient->mi_base_de_datos;
$mongoCollection = $mongoDB->Empleados;
$result = $mysqli->query("SELECT * FROM Empleados");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mongoCollection->insertOne([
            'CodEmple'    => $row['CodEmple'],
            'Nombre'      => $row['Nombre'],
            'Apellido1'   => $row['Apellido1'],
            'Apellido2'   => $row['Apellido2'],
            'Departamento'=> $row['Departamento']
        ]);
    }
    echo "Migración completada exitosamente.";
} else {
    echo "No se encontraron registros en la tabla MySQL.";
}
$mysqli->close();



?>