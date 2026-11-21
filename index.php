<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Requerir Controladores y Conexión
require_once __DIR__ . '/app/controllers/UsuarioController.php';
require_once __DIR__ . '/app/controllers/RolController.php';
require_once __DIR__ . '/app/controllers/ClienteController.php';
require_once __DIR__ . '/app/controllers/EncomiendaController.php';
require_once __DIR__ . '/app/config/Conexion.php';

$rolController = new RolController();
$usuarioController = new UsuarioController();
$clienteController = new ClienteController();

$conexion = Conexion::getConnection();
$encomiendaController = new EncomiendaController($conexion);

$accion = $_GET['accion'] ?? $_GET['action'] ?? 'inicio';

function verificarAcceso($rolesPermitidos = [1, 2]) {
    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['idUsuario'])) {
        header('Location: index.php?accion=login');
        exit();
    }
    // Verificar si el rol del usuario esta permitido
    if (!in_array($_SESSION['idRol'] ?? null, $rolesPermitidos)) {
        echo "<h3>Acceso Denegado. No tienes permisos para ver esta sección.</h3>";
        exit();
    }
}

switch ($accion) {
    // RUTAS PÚBLICAS (No requieren sesión)
    case 'inicio':
        require __DIR__ . '/app/views/public/inicio.php';
        break;

    case 'iniciarSesion':
        $usuarioController->login();
        break;

    case 'consultarTracking':
        require __DIR__ . '/app/views/public/consultar_tracking.php';
        break;

    // DASHBOARDS POR ROL
    case 'dashboardAdmin':
        verificarAcceso([1]);
        require __DIR__ . '/app/views/dashboard/admin.php';
        break;

    case 'dashboardOperador':
        verificarAcceso([2]);
        require __DIR__ . '/app/views/dashboard/operador.php';
        break;

    // MÓDULOS DE ADMINISTRADOR (Solo idRol = 1)
    case 'formularioUsuario':
        verificarAcceso([1]);
        $usuarioController->registro();
        break;

    case 'guardarUsuario':
        verificarAcceso([1]);
        $usuarioController->guardar();
        break;

    case 'listarUsuarios':
        verificarAcceso([1]);
        $usuarioController->listar();
        break;

    case 'listarRoles':
        verificarAcceso([1]);
        $rolController->listar();
        break;

    // MÓDULOS OPERATIVOS (Admin y Operador)
    case 'registroCliente':
        verificarAcceso([1, 2]);
        $clienteController->formulario();
        break;

    case 'guardarCliente':
        verificarAcceso([1, 2]);
        $clienteController->guardar();
        break;

    case 'listarClientes':
        verificarAcceso([1, 2]);
        $clienteController->listar();
        break;

    case 'editarCliente':
        verificarAcceso([1, 2]);
        $clienteController->editar();
        break;

    case 'actualizarCliente':
        verificarAcceso([1, 2]);
        $clienteController->actualizar();
        break;

    case 'eliminarCliente':
        verificarAcceso([1, 2]);
        $clienteController->eliminar();
        break;

    case 'registroEncomienda':
        verificarAcceso([1, 2]);
        $encomiendaController->mostrarFormulario();
        break;
        
    case 'guardarEncomienda':
        verificarAcceso([1, 2]);
        $encomiendaController->guardar();
        break;
        
    case 'listarEncomiendas':
        verificarAcceso([1, 2]);
        $encomiendaController->listar();
        break;

    case 'listarVehiculos':
        verificarAcceso([1, 2]);
        $encomiendaController->listar();
        break;

    

    // CERRAR SESIÓN
    case 'logout':
        session_destroy();
        header('Location: index.php?accion=inicio');
        exit();

    default:
        http_response_code(404);
        echo '<h2>404 - Página no encontrada</h2>';
        break;
}