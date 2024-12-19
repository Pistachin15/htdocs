<?php
class Vehiculo{
    private  $color;
    private  $peso;

    function circula(){}

    function aniadir_persona( $peso_persona){}
}

class Cuatro_ruedas extends Vehiculo{
    private  $numero_puertas;

    function repintar($color){}
}

class Coche extends Cuatro_ruedas{
    private  $numero_cadenas_nieve;

    function aniadir_cadenas_nieve($num){}

    function quitar_cadenas_nieve($num){}

}

class Dos_ruedas extends Vehiculo{
    private $cilindrada;

    function poner_gasolina($litros){}

}

class Camion extends Cuatro_ruedas{
    private $longitud;

    function aniadir_remolque($longitud_remolque){}
}
?>