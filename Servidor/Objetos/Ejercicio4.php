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
    
    public function getpeso(){
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


//Clase Cuatro_ruedas

class Cuatro_ruedas extends Vehiculo{

    //Atributos

    private  $numero_puertas;

    //getter y setter

    public function setNumPuertas($numero_puertas){
        $this->numero_puertas = $numero_puertas;
    }
    
    public function getNumPuertas(){
        return $this->numero_puertas;
    }
    //Metodos


    function repintar($color){
        $this->setColor($color);
    }
}



//Clase Coche

class Coche extends Cuatro_ruedas{

    //Atributos

    private  $numero_cadenas_nieve;

    //Constructores

    public function __construct($color, $peso, $numero_cadenas_nieve){
        parent::__construct($color, $peso);
        $this->numero_cadenas_nieve = $numero_cadenas_nieve;
    }

    //getter y setter

    public function setNumeroCadenas($numero_cadenas_nieve){
        $this->numero_cadenas_nieve = $numero_cadenas_nieve;
    }
    
    public function getNumeroCadenas(){
        return $this->numero_cadenas_nieve;
    }

    //Metodos

    function aniadir_cadenas_nieve($num){
        $cadenasTotales = $this->getNumeroCadenas();
        $this->setNumeroCadenas($cadenasTotales + $num);
        

    }

    function quitar_cadenas_nieve($num){

        $cadenasTotales = $this->getNumeroCadenas();

        if ($cadenasTotales < 0 ){
            
            echo "No puedes quitar más porque no hay";
        
        } else{

            $this->setNumeroCadenas($cadenasTotales - $num);
        } 
    }



}

//Clase Dos_ruedas

class Dos_ruedas extends Vehiculo{
    private $cilindrada;

    function poner_gasolina($litros){
        $this->setPeso += $litros;
    }

}

//Clase Camion

class Camion extends Cuatro_ruedas{
    
    //Atributos
    
    private $longitud;

    //getter y setter

    public function setLongitud($longitud){
        $this->longitud = $longitud;
    }
    
    public function getLongitud(){
        return $this->longitud;
    }

    //Metodos

    function aniadir_remolque($longitud_remolque){

        $this->setLongitud += $longitud_remolque;
    }
}


?>