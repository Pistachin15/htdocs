<html lang="es">
<body>

 <header>

    </header>

    <article>
        <form action="#" method="post" class="mi-formulario">
            <label for="mes">Introduce un mes:</label>
            <input type="text" id="num1" name="mes" required>
            <label for="año">Introduce un año:</label>
            <input type="text" id="num2" name="año" required>
            <input type="submit" value="Enviar" name=boton>
        </form>
    </article>

</body>

</html>


<?php
if(isset($_POST['boton'])){
?>

<table>
    <tr>
        <th>lunes</th>
        <th>Martes</th>
        <th>Miercoles</th>
        <th>Jueves</th>
        <th>Viernes</th>
        <th>Sabado</th>
        <th>Domingo</th>
        
    </tr>
</table>


<?php
} 

?>