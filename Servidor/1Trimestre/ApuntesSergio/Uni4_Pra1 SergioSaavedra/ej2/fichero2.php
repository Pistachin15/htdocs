<?php
    /*
        Diseñar el siguiente formulario, se ha de resolver con dos script:
        Y obtener el siguiente mensaje al pulsar el botón RESULTADO:
             Menos de 14 años : eres una personita
             Entre 15 y 20 años: todavía eres muy joven
             De 21 a 40 años: eres una persona joven
             Entre 41 y 60 años: eres una persona madura
             Más de 60 años: Ya eres una persona mayor
             Aún no me has dicho tu edad
    */

    if (isset($_POST['edad'])) {
        switch ($_POST['edad']) {
            case "-14":
                echo "eres una personita";
            break;
            case "15_20":
                echo "todavía eres muy joven";
            break;
            case "21_40":
                echo "eres una persona joven";
            break;
            case "41_60":
                echo "eres una persona madura";
            break;
            case "+60":
                echo "Ya eres una persona mayor";
            break;
            default:
                echo "Aún no me has dicho tu edad";
            break;
        }
        
    } else {
        echo "Aún no me has dicho tu edad";
    }

    
?>