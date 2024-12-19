<?php // query-mysqli.php
require_once 'login.php';
$connection = new mysqli($hn, $un, $pw, $db);
if ($connection->connect_error) die("Fatal Error");
$query = "SELECT * FROM usuarios";
$result = $connection->query($query);
if (!$result) die("Fatal Error");
$rows = $result->num_rows;
for ($j = 0 ; $j < $rows ; ++$j)
{
$result->data_seek($j);
echo 'ID: ' .htmlspecialchars($result->fetch_assoc()['ID']) .'<br>'; 
$result->data_seek($j);
echo 'USU: ' .htmlspecialchars($result->fetch_assoc()['USU']) .'<br>';
$result->data_seek($j);
echo 'CONTRA: ' .htmlspecialchars($result->fetch_assoc()['CONTRA']) .'<br>';
$result->data_seek($j);
echo 'ROL: '. htmlspecialchars($result->fetch_assoc()['ROL'])
.'<br><br>';
/* $result->data_seek($j);
echo 'ISBN: ' .htmlspecialchars($result->fetch_assoc()['isbn'])
.'<br><br>'; */
}
$result->close();
$connection->close();
?>