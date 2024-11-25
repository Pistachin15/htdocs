<?php 
//Conexion a la base de datos  
 require_once 'login.php';
 $conn = new mysqli($hn, $un, $pw, $db, 3307);
 if ($conn->connect_error) die("Fatal Error"); 

//Consulta a la base de datos

 $query = "SELECT usu, contra
         FROM usuarios";
 $result = $conn->query($query);
 if (!$result) die("Fatal Error");

 //Mostrar datos
 $rows = $result->num_rows;
 for ($j = 0 ; $j < $rows ; ++$j){
 $result->data_seek($j);
 echo 'Usuario: ' .htmlspecialchars($result->fetch_assoc()['usu']) .'<br>';
 $result->data_seek($j);
 echo 'Contraseña: ' .htmlspecialchars($result->fetch_assoc()['contra']) .'<br>';

 } 
 $result->close();
 $connection->close();
?>