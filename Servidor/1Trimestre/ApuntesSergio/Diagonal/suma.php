<?php
    function suma ($arr) {
        $resul = 0;

        foreach ($arr as $num) {
            $resul = $resul + $num;
        }

        return $resul;
    }
?>