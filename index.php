<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/app/config/Conexion.php';
require_once __DIR__ . '/app/controllers/UsuarioController.php';
require_once __DIR__ . '/app/controllers/RolController.php';
require_once __DIR__ . '/app/controllers/ClienteController.php';
require_once __DIR__ . '/app/controllers/EncomiendaController.php';
require_once __DIR__ . '/app/controllers/VehiculoController.php';
require_once __DIR__ . '/app/controllers/ChoferController.php';

$rolController = new RolController();
$usuarioController = new UsuarioController();
$clienteController = new ClienteController();
$vehiculoController = new VehiculoController();
$choferController = new ChoferController();

$conexion = Conexion::getConnection();
$encomiendaController = new EncomiendaController($conexion);

$accion = $_GET['accion'] ?? $_GET['action'] ?? 'inicio';

function verificarAcceso($rolesPermitidos = [1, 2]) {
    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['idUsuario'])) {
        header('Location: index.php?accion=iniciarSesion');
        exit();
    }
    // Verificar si el rol del usuario está permitido
    if (!in_array($_SESSION['idRol'] ?? null, $rolesPermitidos)) {
        http_response_code(403);
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
    case 'login':
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

    case 'editarEncomienda':
        verificarAcceso([1, 2]);
        $encomiendaController->editar();
        break;

    case 'actualizarEncomienda':
        verificarAcceso([1, 2]);
        $encomiendaController->actualizar();
        break;

    case 'eliminarEncomienda':
        verificarAcceso([1, 2]);
        $encomiendaController->eliminar();
        break;

    // MÓDULO DE CIUDADES Y ENVÍOS
    case 'listarCiudades':
    case 'registroCiudad':
        verificarAcceso([1, 2]);
        require_once __DIR__ . '/app/controllers/CiudadController.php';
        $ciudadController = new CiudadController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ciudadController->registrar(trim($_POST['nombre']), trim($_POST['departamento']));
            header('Location: index.php?accion=listarCiudades');
            exit();
        }
        $ciudades = $ciudadController->listar();
        require __DIR__ . '/app/views/ciudades/gestionar.php';
        break;

    case 'listarEnvios':
    case 'registroEnvio':
    case 'registroRuta':
        verificarAcceso([1, 2]);
        require_once __DIR__ . '/app/controllers/EnvioController.php';
        require_once __DIR__ . '/app/controllers/CiudadController.php';
        $envioController = new EnvioController();
        $ciudadController = new CiudadController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $envioController->programarEnvio(
                $_POST['id_encomienda'],
                $_POST['id_ciudad_origen'],
                $_POST['id_ciudad_destino'],
                $_POST['id_vehiculo'],
                $_POST['id_chofer'],
                $_POST['fecha_salida'],
                $_POST['fecha_llegada']
            );
            header('Location: index.php?accion=listarEnvios');
            exit();
        }
        $envios = $envioController->listar();
        $ciudades = $ciudadController->listar();
        require __DIR__ . '/app/views/envios/gestionar.php';
        break;

    // MÓDULO DE VEHÍCULOS Y CHOFERES
    case 'listarVehiculos':
        verificarAcceso([1, 2]);
        $vehiculos = $vehiculoController->listar();
        require __DIR__ . '/app/views/vehiculos/listar.php';
        break;

    case 'registroVehiculo':
        verificarAcceso([1, 2]);
        $mensaje = $vehiculoController->registrar();
        require __DIR__ . '/app/views/vehiculos/registrar.php';
        break;

    case 'vehiculosDisponibles':
        verificarAcceso([1, 2]);
        $vehiculos = $vehiculoController->listarDisponibles();
        require __DIR__ . '/app/views/vehiculos/disponibles.php';
        break;

    case 'editarVehiculo':
        verificarAcceso([1, 2]);
        $id = $_GET['id'] ?? '';
        $mensaje = $vehiculoController->actualizar($id);
        $vehiculo = $vehiculoController->buscar($id);
        require __DIR__ . '/app/views/vehiculos/editar.php';
        break;

    case 'eliminarVehiculo':
        verificarAcceso([1, 2]);
        $mensaje = $vehiculoController->eliminar();
        $vehiculos = $vehiculoController->listar();
        require __DIR__ . '/app/views/vehiculos/listar.php';
        break;

    case 'listarChoferes':
        verificarAcceso([1, 2]);
        $choferes = $choferController->listar();
        require __DIR__ . '/app/views/choferes/listar.php';
        break;

    case 'registroChofer':
        verificarAcceso([1, 2]);
        $mensaje = $choferController->registrar();
        require __DIR__ . '/app/views/choferes/registrar.php';
        break;

    case 'editarChofer':
        verificarAcceso([1, 2]);
        $id = $_GET['id'] ?? '';
        $mensaje = $choferController->actualizar($id);
        $chofer = $choferController->buscar($id);
        require __DIR__ . '/app/views/choferes/editar.php';
        break;

    case 'eliminarChofer':
        verificarAcceso([1, 2]);
        $mensaje = $choferController->eliminar();
        $choferes = $choferController->listar();
        require __DIR__ . '/app/views/choferes/listar.php';
        break;

    // CERRAR SESIÓN
    case 'logout':
        session_unset();
        session_destroy();
        header('Location: index.php?accion=inicio');
        exit();

    default:
        http_response_code(404);
        echo '<h2>404 - Página no encontrada</h2>';
        break;
}