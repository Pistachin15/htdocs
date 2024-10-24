<?php
abstract class Vehiculo {
    private $color;
    private $peso;
    protected static $numero_cambio_color = 0;
    const SALTO_DE_LINEA = '<br />';

    public function __construct($color, $peso) {
        $this->color = $color;
        $this->setPeso($peso);
    }

    public function setPeso($peso) {
        // Limitar el peso máximo a 2100 kg
        if ($peso <= 2100) {
            $this->peso = $peso;
        } else {
            echo "El peso no puede exceder los 2100 kg." . self::SALTO_DE_LINEA;
        }
    }

    public function getPeso() {
        return $this->peso;
    }

    public function setColor($color) {
        $this->color = $color;
        self::$numero_cambio_color++; // Incrementar el contador de cambios de color
    }

    public function getColor() {
        return $this->color;
    }

    public function circula() {
        echo self::SALTO_DE_LINEA . "El vehículo circula" . self::SALTO_DE_LINEA;
    }

    abstract public function aniadir_persona($peso_persona);

    public static function ver_atributo($objeto) {
        echo "Color: " . $objeto->getColor() . self::SALTO_DE_LINEA;
        echo "Peso: " . $objeto->getPeso() . " kg" . self::SALTO_DE_LINEA;

        if ($objeto instanceof Cuatro_ruedas) {
            echo "Número de puertas: " . $objeto->getNumPuertas() . self::SALTO_DE_LINEA;
        }

        if ($objeto instanceof Dos_ruedas) {
            echo "Cilindrada: " . $objeto->getCilindrada() . self::SALTO_DE_LINEA;
        }

        if ($objeto instanceof Camion) {
            echo "Longitud: " . $objeto->getLongitud() . self::SALTO_DE_LINEA;
        }

        if ($objeto instanceof Coche) {
            echo "Número de cadenas de nieve: " . $objeto->getNumeroCadenas() . self::SALTO_DE_LINEA;
        }

        echo "Número de cambios de color: " . self::$numero_cambio_color . self::SALTO_DE_LINEA;
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
        if ($this->getPeso() >= 1500 && $this->numero_cadenas_nieve <= 2) {
            echo "Atención, ponga 4 cadenas para la nieve." . self::SALTO_DE_LINEA;
        }
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
