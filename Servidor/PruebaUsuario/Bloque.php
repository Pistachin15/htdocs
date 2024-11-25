<?php
$usuario = "Bautista";
$contrasenia = 12345;
$usuConfirmar = $_POST['usu'];
$contraConfirmar = $_POST['contra'];

if($usuConfirmar == $usuario && $contraConfirmar == $contraseña){
    echo "Bienvenido, $usuario";
}
else {
    echo "Los datos introducidos no son válidos, vuelva a intentarlo:<br>";
    
    ?> <a href='Acceso.php'>Volver a Iniciar Sesión</a>
<?php
}

?>