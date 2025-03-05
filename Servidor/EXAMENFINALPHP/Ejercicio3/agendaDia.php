<?php
session_start();
echo "<h1>Listado pictogramas</h1>";
require_once '../login.php';

$conn = new mysqli($hn, $un, $pw, $db, $conn);
if ($conn->connect_error) die("Error en la conexión.");

$fecha = $_SESSION['fecha'];
$idPersona = $_SESSION['idPersona'];
var_dump($idPersona);
// Obtener el id del usuario

?>



