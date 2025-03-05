<?php
session_start();
require_once '../login.php';


$conn = new mysqli($hn, $un, $pw, $db, $conn);
if ($conn->connect_error) die("Error en la conexión."); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST['Enviar'])){
    $persona = $_POST['persona'];
    $fecha = $_POST['fecha'];

    $_SESSION['fecha'] = $fecha;

    $consultaId = "SELECT idpersona FROM personas WHERE nombre = '$persona'"; //Consulta para recoger el id del usuario
    $resultado = $conn->query($consultaId); //Ejecutamos la consulta y lo almacenamos en una variable
    $fila = $resultado->fetch_assoc(); //Adelanto 1 posicion del array (-1 a 0) y almaceno lam fila en la variable
    $idPersona = $fila['idpersona']; //Almacenamos el id de la columan id_usu en una variable 
    $_SESSION['idPersona'] = $idPersona;
    header('Location: agendaDia.php'); 


} else if(isset($_POST['Volver'])){
    header('Location: ../Ejercicio1/catalogoPictogramas.php');
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form action="verAgenda.php" method="POST">
        <h2>Ver agenda</h2>
        <div>
            <label for="fecha"><strong>Fecha:</strong></label>
            <input type="date" id="fecha" name="fecha" required>
        </div>
        <div>
            <label for="persona" class="form-label"><strong>Persona:</strong></label>
            <input type="text" id="persona" name="persona" class="form-control" required>
        </div>
        <div class="d-flex justify-content-center">
                <button type="submit" id="Enviar" name="Enviar">Mostrar agenda</button>

        </div>
    </form>
    <form action="../Ejercicio1/catalogoPictogramas.php" method="post">
    <button type="submit">Volver al listado</button>
</form>
</body>
</html>
