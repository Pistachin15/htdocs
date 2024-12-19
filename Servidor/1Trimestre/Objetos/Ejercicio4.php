<?php
abstract class Vehiculo {
    // Atributos
    private $color;
    private $peso;

    // Constructor
    public function __construct($color, $peso) {
        $this->color = $color;
        $this->peso = $peso;
    }

    // Getters y Setters
    public function setPeso($peso_persona) {
        $this->peso = $peso_persona;
    }

    public function getPeso() {
        return $this->peso;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getColor() {
        return $this->color;
    }

    // Métodos
    public function circula() {
        echo "<br>El vehículo circula<br>";
    }

    abstract public function aniadir_persona($peso_persona);

    // Método estático para mostrar atributos
    public static function ver_atributo($objeto) {
        echo "Color: " . $objeto->getColor() . "<br>";
        echo "Peso: " . $objeto->getPeso() . " kg<br>";
        
        if ($objeto instanceof Cuatro_ruedas) {
            echo "Número de puertas: " . $objeto->getNumPuertas() . "<br>";
        }

        if ($objeto instanceof Dos_ruedas) {
            echo "Cilindrada: " . $objeto->getCilindrada() . "<br>";
        }

        if ($objeto instanceof Camion) {
            echo "Longitud: " . $objeto->getLongitud() . "<br>";
        }

        if ($objeto instanceof Coche) {
            echo "Número de cadenas de nieve: " . $objeto->getNumeroCadenas() . "<br>";
        }
    }

    public function __toString() {
        return "Vehículo Color: $this->color, Peso: $this->peso kg";
    }
}



//Clase Cuatro_ruedas

class Cuatro_ruedas extends Vehiculo {
    // Atributos
    private $numero_puertas;

    // Getters y Setters
    public function setNumPuertas($numero_puertas) {
        $this->numero_puertas = $numero_puertas;
    }

    public function getNumPuertas() {
        return $this->numero_puertas;
    }

    // Métodos
    public function repintar($color) {
        $this->setColor($color);
    }

    public function aniadir_persona($peso_persona) {
        $this->setPeso($this->getPeso() + $peso_persona);
    }
}




//Clase Coche

class Coche extends Cuatro_ruedas {
    // Atributos
    private $numero_cadenas_nieve;

    // Constructor
    public function __construct($color, $peso, $numero_cadenas_nieve, $numero_puertas) {
        parent::__construct($color, $peso);
        $this->numero_cadenas_nieve = $numero_cadenas_nieve;
        $this->setNumPuertas($numero_puertas);
    }

    // Getters y Setters
    public function setNumeroCadenas($numero_cadenas_nieve) {
        $this->numero_cadenas_nieve = $numero_cadenas_nieve;
    }

    public function getNumeroCadenas() {
        return $this->numero_cadenas_nieve;
    }

    // Métodos
    public function aniadir_persona($peso_persona) {
        parent::aniadir_persona($peso_persona);
    }

    public function __toString() {
        return parent::__toString() . ", Número de cadenas de nieve: $this->numero_cadenas_nieve";
    }
}


//Clase Dos_ruedas

class Dos_ruedas extends Vehiculo {
    // Atributos
    private $cilindrada;

    // Getter y Setter
    public function setCilindrada($cilindrada) {
        $this->cilindrada = $cilindrada;
    }

    public function getCilindrada() {
        return $this->cilindrada;
    }

    // Métodos
    public function poner_gasolina($litros) {
        $pesoDosRuedas = $this->getPeso();
        $this->setPeso($pesoDosRuedas + $litros);
    }

    public function aniadir_persona($peso_persona) {
        $this->setPeso($this->getPeso() + $peso_persona + 2); // +2 kg por el casco
    }
}


//Clase Camion

class Camion extends Cuatro_ruedas {
    // Atributos
    private $longitud;

    // Constructor
    public function __construct($color, $peso, $longitud) {
        parent::__construct($color, $peso);
        $this->longitud = $longitud;
    }

    // Getters y Setters
    public function setLongitud($longitud) {
        $this->longitud = $longitud;
    }

    public function getLongitud() {
        return $this->longitud;
    }

    // Métodos
    public function aniadir_remolque($longitud_remolque) {
        $LongitudTotal = $this->getLongitud();
        $this->setLongitud($LongitudTotal + $longitud_remolque);
    }

    public function __toString() {
        return parent::__toString() . ", Longitud: $this->longitud";
    }
}



?>