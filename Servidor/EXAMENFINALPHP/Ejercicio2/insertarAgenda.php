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
$contadorImagenes = 1;

if(isset($_POST['Enviar'])){
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $persona = $_POST['persona'];
    $imagen = $_POST['imagen'];

    //Recogemos el id de la persona
    $consultaId = "SELECT idpersona FROM personas WHERE nombre = '$persona'"; //Consulta para recoger el id del usuario
    $resultado = $conn->query($consultaId); //Ejecutamos la consulta y lo almacenamos en una variable
    $fila = $resultado->fetch_assoc(); //Adelanto 1 posicion del array (-1 a 0) y almaceno lam fila en la variable
    $idPersona = $fila['idpersona']; //Almacenamos el id de la columan id_usu en una variable 

    //Recogemos el id de la imagen
    $consultaIdImagen = "SELECT idimagen FROM imagenes WHERE imagen = '$imagen'"; //Consulta para recoger el id de la imagen
    $resultadoImagen = $conn->query($consultaIdImagen); //Ejecutamos la consulta y lo almacenamos en una variable
    $filaImagen = $resultadoImagen->fetch_assoc(); //Adelanto 1 posicion del array (-1 a 0) y almaceno lam fila en la variable
    $idImagen = $filaImagen['idimagen']; //Almacenamos el id de la columna idimagen en una variable

    $insertarConsulta = "INSERT INTO agenda (fecha, hora, idpersona, idimagen) VALUES ('$fecha', '$hora', '$idPersona', '$idImagen')"; //consulta para recoger las rutas de imagenes
    $resultadoConsulta = $conn->query($insertarConsulta); //Ejecutamos la consulta

    if($resultadoConsulta === TRUE){
        echo "Consulta hecha correctamente";
    }


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar entrada</title>
</head>
<body>
<form action="insertarAgenda.php" method="post">
            <div>
                <label for="fecha"><strong>Fecha:</strong></label>
                <input type="date" id="fecha" name="fecha" required>
            </div>
            <div class="mb-3">               
                <label for="hora">Hora:</label>
                <input type="time" id="hora" name="hora">
            </div>
            <div>
            <div>
                <label for="persona" class="form-label"><strong>Persona:</strong></label>
                <input type="text" id="persona" name="persona" class="form-control" required>
            <div>
                <label for="condicion" class="form-label">Selecciona una imagen</label><br>
                <div class="form-check form-check-inline">
                <table border="1">
                    <tr>
                    <?php 
                    while($fila = $resultadoImagenes->fetch_assoc()){?> 
                        <?php  $fila2 = $resultadoDescripcion->fetch_assoc() ?>
                        <td>
                        <img src="../<?php echo htmlspecialchars($fila['imagen']); ?>"<br>
                        <h2>Imagen <?php  echo "$contadorImagenes"?></h2>
                        <input class="form-check-input" type="radio" id="hipoglucemia" name="imagen" value="<?php echo htmlspecialchars($fila['imagen']); ?>">
                        </td>
                        <?php
                        $contador++;
                        $contadorImagenes++;
                        if($contador % 4 == 0){
                            echo "<tr></tr>";
                    }}?>
                    </tr>
                </table>
            </div>
            </div>
                <button type="submit" class="btn btn-primary" id="Enviar" name="Enviar">Enviar</button>
            </div>
        </form>
        <form action="insertarAgenda.php" method="post">
            <button type="submit" class="btn btn-primary" id="Enviar" name="Enviar">Volver a insertar</button>
        </form>
        
</body>
</html>