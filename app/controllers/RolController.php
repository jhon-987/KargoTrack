<?php

require_once __DIR__ . '/../models/Rol.php';

class RolController {

    private $rol;

    public function __construct() {
        $this->rol = new Rol();
    }

    public function listar() {
        $roles = $this->rol->listar();
        require __DIR__ . '/../views/roles/listar.php';
    }
}