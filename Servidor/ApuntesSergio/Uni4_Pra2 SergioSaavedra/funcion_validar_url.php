<?php
/*
    Desarrollar una función en PHP que reciba una URL y validar si este es correcto, la
    función se llamará funcion_validar_url.php
*/

function validarURL($url) {
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return false;
    } else {
        return true;
    }
}

?>