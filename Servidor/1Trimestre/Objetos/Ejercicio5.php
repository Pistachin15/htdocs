<?php
abstract class Vehiculo {
    private $color;
    private $peso;

    public function __construct($color, $peso) {
        $this->color = $color;
        $this->peso = $peso;
    }

    public function setPeso($peso) {
        $this->peso = $peso;
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

    public function circula() {
        echo "<br>El vehículo circula<br>";
    }

    abstract public function aniadir_persona($peso_persona);

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

class Cuatro_ruedas extends Vehiculo {
    private $numero_puertas;

    public function __construct($color, $peso, $numero_puertas) {
        parent::__construct($color, $peso);
        $this->numero_puertas = $numero_puertas;
    }

    public function setNumPuertas($numero_puertas) {
        $this->numero_puertas = $numero_puertas;
    }

    public function getNumPuertas() {
        return $this->numero_puertas;
    }

    public function repintar($color) {
        $this->setColor($color);
    }

    public function aniadir_persona($peso_persona) {
        $this->setPeso($this->getPeso() + $peso_persona);
    }
}

class Coche extends Cuatro_ruedas {
    private $numero_cadenas_nieve;

    public function __construct($color, $peso, $numero_cadenas_nieve, $numero_puertas) {
        parent::__construct($color, $peso, $numero_puertas);
        $this->numero_cadenas_nieve = $numero_cadenas_nieve;
    }

    public function setNumeroCadenas($numero_cadenas_nieve) {
        $this->numero_cadenas_nieve = $numero_cadenas_nieve;
    }

    public function getNumeroCadenas() {
        return $this->numero_cadenas_nieve;
    }

    public function aniadir_persona($peso_persona) {
        parent::aniadir_persona($peso_persona);
    }

    public function __toString() {
        return parent::__toString() . ", Número de cadenas de nieve: $this->numero_cadenas_nieve";
    }
}

class Dos_ruedas extends Vehiculo {
    private $cilindrada;

    public function __construct($color, $peso) {
        parent::__construct($color, $peso);
    }

    public function setCilindrada($cilindrada) {
        $this->cilindrada = $cilindrada;
    }

    public function getCilindrada() {
        return $this->cilindrada;
    }

    public function poner_gasolina($litros) {
        $this->setPeso($this->getPeso() + $litros);
    }

    public function aniadir_persona($peso_persona) {
        $this->setPeso($this->getPeso() + $peso_persona + 2); // +2 kg por el casco
    }
}

class Camion extends Cuatro_ruedas {
    private $longitud;

    public function __construct($color, $peso, $longitud) {
        parent::__construct($color, $peso, 2); // Asumiendo 2 puertas por defecto
        $this->longitud = $longitud;
    }

    public function setLongitud($longitud) {
        $this->longitud = $longitud;
    }

    public function getLongitud() {
        return $this->longitud;
    }

    public function aniadir_remolque($longitud_remolque) {
        $this->setLongitud($this->getLongitud() + $longitud_remolque);
    }

    public function __toString() {
        return parent::__toString() . ", Longitud: $this->longitud";
    }
}
?>
