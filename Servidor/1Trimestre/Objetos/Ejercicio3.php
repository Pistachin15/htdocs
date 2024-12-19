<?php
class Vehiculo{

    //Atributos
    private  $color;
    private  $peso;

    //Constructores

    public function __construct($color, $peso){
        $this->color = $color;
        $this->peso = $peso;
    }

    //get y set
    public function setpeso($peso_persona){
        $this->peso = $peso_persona;
    }
    
    public function getpeso($peso){
        return $this->peso;
    }

    public function setColor($color) {
            $this->color = $color;
    }
        
    public function getColor() {
            return $this->color;
    }

    //Metodos

    public function circula(){
        echo "<br>El vehículo circula<br>";
    }


    public function aniadir_persona($peso_persona){
        $this->peso += $peso_persona;
    }

    public function __toString(){
        return "Vehiculo Color: $this->color , Peso: $this->peso kg";
    }
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