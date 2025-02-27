<?php
require_once('conexion.php');
session_start();
function autenticarUsuario($login, $clave) {
    global $conn;

    // Evitar inyección SQL usando consultas preparadas
    $stmt = $conn->prepare("SELECT * FROM jugador WHERE login=? AND clave=?");
    $stmt->bind_param("ss", $login, $clave);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado
    $result = $stmt->get_result();

    // Verificar si se encontró un usuario
    if ($result->num_rows === 1) {
        // Usuario autenticado
        $result->data_seek(0); 
        $_SESSION['nom'] = htmlspecialchars($result->fetch_assoc()['nombre']);
        return true;
    } else {
        // Usuario no autenticado
        return false;
    }

    // Cerrar la consulta y la conexión
    $stmt->close();
    $conn->close();
}
?>