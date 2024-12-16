<?php
require_once 'login.php';
$connection = new mysqli($hn, $un, $pw, $db);
if ($connection->connect_error) die("Fatal Error");
$query = "INSERT INTO usuarios (USU,CONTRA,ROL) VALUES ('yolanda','yolanda','JUGADOR')";
$result = $connection->query($query);
if (!$result) die("Fatal Error");

$connection->close();
?>