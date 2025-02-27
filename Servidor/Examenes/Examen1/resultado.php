<?php
session_start(); // Inicia sesión

require_once 'login.php'; // Incluye la conexión a la base de datos

$usuario = $_SESSION['login'] ?? 'Invitado';
echo "<h1>Bienvenid@, $usuario </h1><br>";

if (isset($_SESSION['resultado']) && $_SESSION['resultado']) {
    $pos1 = $_SESSION['Posicion1'];
    $pos2 = $_SESSION['Posicion2'];
    $contador = $_SESSION['contador'];
    
    echo "<h1>Acierto posiciones $pos1 y $pos2 después de $contador intentos</h1><br>";
    echo "<h3>Se le aumentará 1 punto, así como $contador intentos</h3><br>";

    // Consulta SQL corregida (se agregan comillas para strings)
    $sumarPuntos = "UPDATE jugador SET puntos = puntos + 1, extra = extra + $contador WHERE login = '$usuario'";

    // Ejecutar la consulta
    if ($conn->query($sumarPuntos) === TRUE) {
        echo "<h3>Puntos actualizados correctamente.</h3><br>";
    } else {
        echo "<h3>Error al actualizar puntos: " . $conn->error . "</h3><br>";
    }

} else {
    $pos1 = $_SESSION['Posicion1'];
    $pos2 = $_SESSION['Posicion2'];
    $contador = $_SESSION['contador'];
    
    echo "<h1>Fallo posiciones $pos1 y $pos2 después de $contador intentos</h1><br>";
    echo "<h3>Se le restará 1 punto, así como $contador intentos</h3><br>";
}

// Mostrar la tabla de puntuaciones
echo "<h2>Puntos por jugador</h2>";

// Consulta para obtener los jugadores y sus puntuaciones
$query = "SELECT nombre, login, puntos, extra FROM jugador";
$result = $conn->query($query);

// Verificar si hay datos
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Nombre</th><th>Usuario</th><th>Puntos</th><th>Extra</th></tr>";
    
    // Recorrer los resultados y mostrarlos en la tabla
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['login']) . "</td>";
        echo "<td>" . $row['puntos'] . "</td>";
        echo "<td>" . $row['extra'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "<p>No hay jugadores registrados.</p>";
}

// Cerrar conexión
$conn->close();

?>
