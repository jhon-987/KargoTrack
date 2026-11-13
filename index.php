<?php

require_once __DIR__ . '/app/controllers/UsuarioController.php';
require_once __DIR__ . '/app/controllers/RolController.php';
require_once __DIR__ . '/app/controllers/ClienteController.php';

$rolController = new RolController();
$usuarioController = new UsuarioController();
$clienteController = new ClienteController(); 

$accion = isset($_GET['accion']) ? $_GET['accion'] : 'inicio';

switch ($accion) {
    case 'inicio':
        require_once __DIR__ . '/app/views/public/inicio.php';
        break;

    case 'login':
    case 'iniciarSesion':
        $usuarioController->login();
        break;

    case 'consultarTracking':
        require_once __DIR__ . '/app/views/public/consultar_tracking.php';
        break;

    case 'formularioCliente':
        $clienteController->formulario();
        break;

    case 'guardarCliente':
        $clienteController->guardar();
        break;

    case 'listarClientes':
        $clienteController->listar();
        break;

    // --- GESTIÓN DE USUARIOS Y ROLES ---
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

    // --- DASHBOARDS POR ROL ---
    case 'dashboardAdmin':
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        if (!isset($_SESSION['idUsuario']) || $_SESSION['idRol'] != 1) {
            header('Location: index.php?accion=login');
            exit();
        }
        require_once __DIR__ . '/app/views/dashboard/admin.php';
        break;

    case 'dashboardOperador':
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        if (!isset($_SESSION['idUsuario']) || $_SESSION['idRol'] != 2) {
            header('Location: index.php?accion=login');
            exit();
        }
        require_once __DIR__ . '/app/views/dashboard/operador.php';
        break;

    case 'dashboardCliente':
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        if (!isset($_SESSION['idUsuario']) || $_SESSION['idRol'] != 3) {
            header('Location: index.php?accion=login');
            exit();
        }
        require_once __DIR__ . '/app/views/dashboard/cliente.php';
        break;

    case 'logout':
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        session_destroy();
        header('Location: index.php?accion=inicio');
        exit();

    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}