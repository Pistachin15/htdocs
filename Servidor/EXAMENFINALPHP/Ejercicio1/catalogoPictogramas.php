<?php
session_start();
echo "<h1>Listado pictogramas</h1>";
require_once '../login.php';


$conn = new mysqli($hn, $un, $pw, $db, $conn);
if ($conn->connect_error) die("Error en la conexión.");

$recogerImagenes = "SELECT imagen FROM imagenes"; //consulta para recoger las rutas de imagenes
$resultadoImagenes = $conn->query($recogerImagenes); //Ejecutamos la consulta
$contador = 0; //Creamos un contador para luego crear la tabla
$recogerDescripcion = "SELECT descripcion FROM imagenes";
$resultadoDescripcion = $conn->query($recogerDescripcion);

?>
<table border="1">
    <tr>
    <?php 
    while($fila = $resultadoImagenes->fetch_assoc()){?> 
        <?php  $fila2 = $resultadoDescripcion->fetch_assoc() ?>
        <td>
        <img src="../<?php echo htmlspecialchars($fila['imagen']); ?>"<br>
        <h2><?php echo htmlspecialchars($fila2['descripcion']); ?></h2>
        <h3><?php echo htmlspecialchars($fila['imagen']) ?></h3>
        </td>
        <?php
        $contador++;
        if($contador % 4 == 0){
            echo "<tr></tr>";
    }}?>
    </tr>
</table>