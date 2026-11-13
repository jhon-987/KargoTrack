<?php

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Rol.php';

class UsuarioController {

    private $usuario;
    private $rol;

    public function __construct() {
        $this->usuario = new Usuario();
        $this->rol = new Rol();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = $_POST['correo'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->usuario->buscarPorUsuario($correo);

            if ($user && password_verify($password, $user['password'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                
                $_SESSION['idUsuario'] = $user['id_usuario'];
                $_SESSION['nombre'] = $user['nombre'];
                $_SESSION['idRol'] = $user['id_rol'];

                header('Location: /KargoTrack/index.php?accion=dashboard');
                exit();
            } else {
                $error = "correo o contraseña incorrectos.";
                require __DIR__ . '/../views/auth/login.php';
            }
        } else {
            require __DIR__ . '/../views/auth/login.php';
        }
    }

    public function registro() {
        $roles = $this->rol->listar();
        require __DIR__ . '/../views/usuarios/registrar.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $apellidos = $_POST['apellidos'] ?? '';
            $correo = $_POST['correo'] ?? '';
            $password = $_POST['password'] ?? '';
            $id_rol = $_POST['id_rol'] ?? '';

            $resultado = $this->usuario->registrar($nombre, $apellidos, $correo, $password, $id_rol);

            if ($resultado) {
                header('Location: /KargoTrack/index.php?accion=login');
                exit();
            } else {
                $error = "no se pudo registrar el usuario. el correo ya podria estar en uso.";
                $roles = $this->rol->listar();
                require __DIR__ . '/../views/usuarios/registrar.php';
            }
        }
    }

    public function listar() {
        $usuarios = $this->usuario->listar();
        require __DIR__ . '/../views/usuarios/listar.php';
    }
}