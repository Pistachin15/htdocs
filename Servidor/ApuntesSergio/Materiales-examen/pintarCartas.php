<?php
    session_start();
    /* $comb = [
        ,
        ["copas_02","copas_02","copas_05","copas_03","copas_05","copas_03"],
        ["copas_02","copas_03","copas_05","copas_05","copas_03","copas_02"]
    ]; */
    

    

    function pintar($levanta) {
        $comb = $_SESSION['baraja'];
        for ($i=0; $i<6; $i++) {
            if ($i==$levanta-1 && $levanta != -1) {
                $archivo = $comb/* [$_SESSION['combinacion']] */[$i].".jpg";
                echo<<<_END
                    <img src='$archivo'>
                _END;
            } else {
                echo<<<_END
                    <img src='boca_abajo.jpg' width='260' height='400'>
                _END;
            }
        }
    }
?>