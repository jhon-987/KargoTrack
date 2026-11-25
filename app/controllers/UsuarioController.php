<?php
require_once __DIR__ . '/../config/Conexion.php';

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

                // sin la carpeta fija para que funcione aunque el proyecto tenga otro nombre
                switch ((int)$user['id_rol']) {
                    case 1: // Administrador
                        header('Location: index.php?accion=dashboardAdmin');
                        break;
                    case 2: // Operador
                        header('Location: index.php?accion=dashboardOperador');
                        break;
                    default:
                        header('Location: index.php?accion=inicio');
                        break;
                }
                exit();

            } else {
                $error = "Correo o contraseña incorrectos.";
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
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?accion=formularioUsuario');
            exit();
        }

        $nombre = trim($_POST['nombre'] ?? '');
        $apellidos = trim($_POST['apellido'] ?? '');
        $correo = trim($_POST['correo'] ?? '');
        $password = $_POST['password'] ?? '';
        $id_rol = filter_var($_POST['id_rol'] ?? '', FILTER_VALIDATE_INT);

        $error = '';
        if (empty($nombre) || empty($apellidos) || empty($correo) || empty($password)) {
            $error = 'Todos los campos son obligatorios.';
        } else if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $error = 'El correo no tiene un formato válido.';
        } else if (strlen($password) < 6) {
            $error = 'La contraseña debe tener al menos 6 caracteres.';
        } else if ($id_rol === false || ($id_rol != 1 && $id_rol != 2)) {
            $error = 'Seleccione un rol válido.';
        } else if ($this->usuario->buscarPorUsuario($correo)) {
            $error = 'Ya existe un usuario registrado con ese correo.';
        }

        if ($error == '') {
            try {
                $this->usuario->registrar($nombre, $apellidos, $correo, $password, $id_rol);
                header('Location: index.php?accion=listarUsuarios&mensaje=registrado');
                exit();
            } catch (PDOException $e) {
                $error = 'No se pudo registrar el usuario.';
            }
        }

        $roles = $this->rol->listar();
        require __DIR__ . '/../views/usuarios/registrar.php';
    }

    public function listar() {
        $mensaje = $_GET['mensaje'] ?? '';
        $usuarios = $this->usuario->listar();
        require __DIR__ . '/../views/usuarios/listar.php';
    }
}