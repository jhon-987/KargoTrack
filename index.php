<<<<<<< HEAD

<?php

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KargoTrack - Sistema de Gestión</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #f5f6fa;
            color: #333;
        }

        header {
            background: #1e293b;
            color: white;
            padding: 22px 40px;
        }

        header h1 {
            margin: 0;
        }

        header p {
            margin-bottom: 0;
            color: #cbd5e1;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
        }

        .container h2 {
            color: #1e293b;
            margin-bottom: 25px;
        }

        .menu {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }

        .card h3 {
            color: #1e40af;
            margin-top: 0;
        }

        .card p {
            color: #64748b;
            line-height: 1.5;
        }

        .card a {
            display: inline-block;
            margin-top: 15px;
            padding: 11px 20px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .card a:hover {
            background: #1d4ed8;
        }

        @media (max-width: 650px) {
            .menu {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<header>
    <h1>KargoTrack</h1>
    <p>Sistema de gestión de encomiendas y transporte</p>
</header>

<div class="container">

    <h2>Panel de Gestión</h2>

    <div class="menu">

        <div class="card">
            <h3>Gestión de Ciudades</h3>
            <p>Registro y consulta de ciudades y departamentos.</p>
            <a href="app/views/ciudades.php">Ingresar</a>
        </div>

        <div class="card">
            <h3>Gestión de Envíos</h3>
            <p>Programación y consulta de envíos y transporte.</p>
            <a href="app/views/envios.php">Ingresar</a>
        </div>

    </div>

</div>

</body>
</html>
=======
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
>>>>>>> origin/main
