
<?php

require_once __DIR__ . '/../models/Ciudad.php';

class CiudadController {

    private $ciudad;

    public function __construct() {
        $this->ciudad = new Ciudad();
    }

    public function registrar($nombre, $departamento) {
        return $this->ciudad->registrar($nombre, $departamento);
    }

    public function listar() {
        return $this->ciudad->listar();
    }
}
