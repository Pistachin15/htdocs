<?php
/*
    Crear el siguiente formulario:
        a. Los campos nombre, e-mail, y sexo se han de introducir de forma
        obligatoria.
        b. Se ha de indicar con el mensaje en rojo “*campos requeridos” así como un * al lado de nombre, e-mail y sexo.
        c. El nombre únicamente ha de admitir letras y espacios en blanco
        d. Email debe de tener un valor correcto.
        e. El sitio web debe de tener un valor correcto
        El resultado (valores de entrada en el formulario) debe de mostrar los datos introducidos
        sean correctos o no.
*/

require_once 'funcion_validar_email.php';
require_once 'funcion_validar_url.php';



function nombreBien() {
    if (isset($_POST['nom'])) {
        if (!preg_match("/^[a-zA-Z\s]+$/",$_POST['nom'])) {
            echo  '<span>* Únicamente se permiten letras y espacios</span>';
            
        } 
    }
}

function emailBien() {
    if (isset($_POST['e-mail'])) {
        if (!validarEmail($_POST['e-mail'])) {
            echo  '<span>* E-mail invalido</span> ';
           
        }
    }
}

function webBien() {
    if (isset($_POST['web'])) {
        if (!validarURL($_POST['web'])) {
            echo  '<span>URL invalida </span> ';
            
        }
    }
}

function generoReq() {
    if (isset($_POST['sexo']) && empty($_POST['sexo'])) {
        echo "<span>* El genero es obligatorio</span>";
    }
    
}



    
    




?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        span {
            color: red;
        }
    </style>
</head>

<body>
    <form action="#" method="post">
        <span>* campos requeridos</span><br>
        <label for="nom">Nombre:</label>
        <input type="text" id="nom" name="nom" required>
        <?php nombreBien();?>
        <br><br>

        <label for="e-mail">E-mail:</label>
        <input type="text" id="e-mail" name="e-mail" required>
        <?php emailBien();?>
        <br><br>
        <label for="web">Website:</label>
        <input type="text" id="web" name="web">
        <?php webBien();?>
        <br><br>
        <label for="com">Comentario:</label>
        <textarea name="com" rows="5" cols="30"></textarea>


        <p>Sexo:</p>
        <input type="radio" id="hombre" name="sexo" value="hombre" required>
        <label for="hombre">Hombre</label>
        <input type="radio" id="mujer" name="sexo" value="mujer" required>
        <label for="mujer">Mujer</label>
        <?php generoReq();?>
        <br>

        <input type="submit" value="Enviar" name="Enviar">
    </form>

</body>

</html>

<?php
if (isset($_POST['nom'])) {
    echo "<h1>Tus datos: </h1>";
    
    echo  $_POST['nom']."<br>";
    echo  $_POST['e-mail']."<br>";
    
    if (isset($_POST['web'])) {
        echo $_POST['web']."<br>";
    }

    if (isset($_POST['com'])) {
        echo $_POST['com']."<br>";
    }

    echo $_POST['sexo'];
}
    

?>