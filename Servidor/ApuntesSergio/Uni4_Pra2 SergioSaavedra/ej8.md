
        Evalúa el siguiente código PHP e indica que hace, ¿para qué sirve la función
        preg_match?, ¿qué parámetros necesita y qué retorna?
            if (empty($_POST["name"])) {
                $nameErr = "El nombre es obligatorio";
            } else {
                $name = test_input($_POST["name"]);
                if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                    $nameErr = "Únicamente se permiten letras y espacios";
                }
            }

            *Primero comprueba si el valor name esta vacio si lo esta cambia $nameERR, si no pone el valor de name a lo que de resultado la funcion test_input
            y comprueba si la expresion regular coincide con $name y si no da cambia $nameERR

            *preg_match realiza una comparación con una expresión regular, necesita como minimo de dos parametros la expresion regular y la cadena a la que se compare 


   