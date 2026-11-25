<?php

require_once __DIR__ . '/../models/Ciudad.php';

class CiudadController {

    private $ciudad;

    public function __construct() {
        $this->ciudad = new Ciudad();
    }

    // devuelve un mensaje de error, o vacio si se registro bien
    public function registrar($nombre, $departamento) {
        if (empty($nombre) || empty($departamento)) {
            return 'El nombre de la ciudad y el departamento son obligatorios.';
        }
        if (strlen($nombre) > 100 || strlen($departamento) > 100) {
            return 'El nombre y el departamento no pueden pasar de 100 caracteres.';
        }
        if ($this->ciudad->existe($nombre, $departamento)) {
            return 'Esa ciudad ya está registrada en ese departamento.';
        }
        try {
            $this->ciudad->registrar($nombre, $departamento);
        } catch (PDOException $e) {
            return 'No se pudo registrar la ciudad.';
        }
        return '';
    }

    public function listar() {
        return $this->ciudad->listar();
    }
}
