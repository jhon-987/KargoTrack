
<?php

require_once __DIR__ . '/app/controllers/UsuarioController.php';

require_once __DIR__ . '/app/controllers/RolController.php';

$rolController = new RolController();

$usuarioController = new UsuarioController();

$accion = $_GET['accion'] ?? 'login';

switch ($accion) {

    case 'login':
        $usuarioController->login();
        break;

    case 'formularioUsuario':
        $usuarioController->registro();
        break;

    case 'listarUsuarios':
        $usuarioController->listar();
        break;

    case 'listarRoles':
        $rolController->listar();
        break;

    default:
        http_response_code(404);
        echo "Página no encontrada";
        break;
}
