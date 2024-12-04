<?php
$conn = new mysqli('localhost', 'root', '', 'bdsimon', 3307);
if ($conn->connect_error) die("Fatal Error"); 

$consulta = "SELECT codigousu, COUNT(*) AS puntos FROM jugadas WHERE acierto='1'
GROUP BY codigousu ORDER BY puntos DESC";


?>