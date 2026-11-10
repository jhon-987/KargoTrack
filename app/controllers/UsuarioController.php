<?php

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Rol.php';

class UsuarioController {

    private $usuario;
    private $rol;

    public function __construct()
    {
        $this->usuario = new Usuario();
        $this->rol = new Rol();
    }

    public function login() {
        require __DIR__ . '/../views/auth/login.php';
    }

    public function registro() {
        $roles = $this->rol->listar();

        require __DIR__ . '/../views/usuarios/registrar.php';
    }

    public function listar() {
        require __DIR__ . '/../views/usuarios/listar.php';
    }
}

