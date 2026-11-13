<?php

require_once __DIR__ . '/app/controllers/UsuarioController.php';
require_once __DIR__ . '/app/controllers/RolController.php';
require_once __DIR__ . '/app/controllers/ClienteController.php';

$rolController = new RolController();
$usuarioController = new UsuarioController();
$clienteController = new ClienteController(); 

$accion = isset($_GET['accion']) ? $_GET['accion'] : 'login';

switch ($accion) {
    case 'login':
    case 'iniciarSesion':
        $usuarioController->login();
        break;

    case 'formularioUsuario':
        $usuarioController->registro();
        break;

    case 'guardarUsuario':
        $usuarioController->guardar();
        break;

    case 'listarUsuarios':
        $usuarioController->listar();
        break;

    case 'listarRoles':
        $rolController->listar();
        break;

    case 'listarClientes':
        $clienteController->listar();
        break;

    case 'formularioCliente':
        $clienteController->formulario();
        break;

    case 'guardarCliente':
        $clienteController->guardar();
        break;

    case 'editarCliente':
        $clienteController->editar();
        break;

    case 'actualizarCliente':
        $clienteController->actualizar();
        break;

    case 'eliminarCliente':
        $clienteController->eliminar();
        break;
    
    case 'dashboard':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['idUsuario'])) {
            header('Location: index.php?accion=login');
            exit();
        }
        require_once __DIR__ . '/app/views/dashboard.php';
        break;

    case 'logout':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: index.php?accion=login');
        exit();

    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}