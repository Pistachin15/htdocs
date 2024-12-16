<?php
    /*
        Supongamos que queremos que los usuarios que entran a nuestro sitio web puedan
        configurar con qué color de fondo de página quieren que aparezca la página cada vez
        que ingresan en el sitio web. El color seleccionado por el visitante lo almacenaremos
        en una cookie. En caso que no exista el color, por defecto es blanco.
        La primera página mostrará un formulario con tres controles de tipo radio para la
        selección del color. También esta página verificará si existe la cookie creada, en caso
        afirmativo fijará el fondo de la página con el valor de la cookie (echo “bgcolor=’……’”
        ). Tengamos en cuenta que la primera vez que ejecutemos este programa la página es
        de color blanco, luego variará según el color seleccionado en el formulario. La
        segunda página debe tener un enlace a la primera que es el formulario.
    */

    
    echo<<<_END
        
        <p>Se crea la cookie</p>
        <a href="ej1.php">Ir a la otra web</a>
    _END;

    if(isset($_POST["color"])) {
        setcookie("color", $_POST["color"], 0, "/");
    }
?>

