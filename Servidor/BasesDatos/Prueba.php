<?php 
// Conexion a la base de datos  
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db, 3307);
if ($conn->connect_error) die("Fatal Error"); 

// Consulta a la base de datos
$query = "SELECT * FROM usuarios";
$result = $conn->query($query);

// Mostrar datos
if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo 'Usuario: ' . htmlspecialchars($row['usu']) . '<br>';
        echo 'Contraseña: ' . htmlspecialchars($row['contra']) . '<br>';
        echo 'Rol: ' . htmlspecialchars($row['rol']) . '<br>';
    }
}

// Inserción de nuevos datos con sentencias preparadas
$nombre = "yolanda";
$contra = "yolanda";
$rol = "jugador";  // Se añade el rol correctamente

// Sentencia preparada para prevenir inyección SQL
$stmt = $conn->prepare("INSERT INTO usuarios (usu, contra, rol) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre, $contra, $rol);  // "sss" indica que son 3 cadenas de texto

// Ejecutar la sentencia y verificar si fue exitosa
if ($stmt->execute()) {
    echo "Nuevo usuario insertado exitosamente.";
} else {
    echo "Error al insertar usuario: " . $stmt->error;
}

$stmt->close();  // Cerrar la sentencia
$conn->close();  // Cerrar la conexión
?>
