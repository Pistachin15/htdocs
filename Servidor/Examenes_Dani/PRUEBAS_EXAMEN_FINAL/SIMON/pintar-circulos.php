<?php
    //^En esta función se colorea los cuatro circulos, se los guarda en un array y finalmente se retornan
    function pintar_circulos($col1,$col2,$col3,$col4) {
        echo<<<_END
            <div class="circulo" style="background-color: $col1"></div>
            <div class="circulo" style="background-color: $col2"></div>
            <div class="circulo" style="background-color: $col3"></div>
            <div class="circulo" style="background-color: $col4"></div>
        _END;
        $arr = [$col1,$col2,$col3,$col4];

        return $arr;
        
    }
?>