<?php
/*
    Desarrollar una función en PHP que reciba un EMAIL y valide si este es correcto, la
    función se llamará funcion_validar_email.php
*/

function validarEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    } else {
        return true;
    }
}
?>