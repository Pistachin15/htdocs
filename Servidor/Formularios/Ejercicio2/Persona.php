<?php
$num = $_POST['resul'];

    switch($num){
        case 14:
            echo "eres una personita";
            break;
        case 20:
            echo " todavía eres muy joven";
            break;
        case 40:
            echo "eres una persona joven";
            break;
        case 60:
            echo " eres una persona madura";
            break;
        case 61:
            echo "Ya eres una persona mayor";
            break;
        default:
            echo "aún no me has dicho tu edad";
            break;
    }

?>