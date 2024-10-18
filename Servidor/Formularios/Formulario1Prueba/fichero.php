<?php
if(isset($_POST['nombre'])){

    echo $_POST ['nombre'];
    echo "<br>";
    echo $_POST ['apellidos'];
    echo "<br>";

} else {

?>


<html lang="es">
<body>

 <header>

    </header>

    <article>
        <form action="#" method="post" class="mi-formulario">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
00
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required>
            <input type="submit" value="Enviar">
        </form>
    </article>

</body>

</html>

<?php

}
?>