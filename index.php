<?php
<<<<<<< HEAD
require_once __DIR__ . '/app/controllers/ClienteController.php';
require_once __DIR__ . '/app/controllers/EncomiendaController.php';

$action = $_GET['action'] ?? 'inicio';

try {
    require __DIR__ . '/app/config/database.php';
    $clienteController = new ClienteController($conexion);
    $encomiendaController = new EncomiendaController($conexion);

    switch ($action) {
        case 'inicio':
            ?>
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>KargoTrack</title>
            </head>
            <body>
                <h1>KargoTrack</h1>
                <nav>
                    <a href="?action=listar_clientes">Clientes</a>
                    <a href="?action=listar_encomiendas">Encomiendas</a>
                </nav>
            </body>
            </html>
            <?php
            break;
        case 'registro_cliente':
            $clienteController->mostrarFormulario();
            break;
        case 'guardar_cliente':
            $clienteController->guardar();
            break;
        case 'listar_clientes':
            $clienteController->listar();
            break;
        case 'registro_encomienda':
            $encomiendaController->mostrarFormulario();
            break;
        case 'guardar_encomienda':
            $encomiendaController->guardar();
            break;
        case 'listar_encomiendas':
            $encomiendaController->listar();
            break;
        default:
            http_response_code(404);
            echo 'Página no encontrada.';
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo '<h1>Error de base de datos</h1><p>' .
        htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') .
        '</p><p>Comprueba que MySQL esté iniciado y que exista la base de datos kargotrack.</p>';
}
=======
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

    case 'dashboardAdmin':
        if (!isset($_SESSION['idUsuario']) || $_SESSION['idRol'] != 1) {
            header('Location: index.php?accion=login');
            exit();
        }
        require_once __DIR__ . '/app/views/dashboard/admin.php';
        break;

    case 'dashboardOperador':
        if (!isset($_SESSION['idUsuario']) || $_SESSION['idRol'] != 2) {
            header('Location: index.php?accion=login');
            exit();
        }
        require_once __DIR__ . '/app/views/dashboard/operador.php';
        break;

    case 'dashboardCliente':
        require_once __DIR__ . '/app/views/dashboard/cliente.php';
        break;

    case 'logout':
        session_destroy();
        header('Location: index.php?accion=inicio');
        exit();

    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}
>>>>>>> jhon
