
<?php

require_once __DIR__ . '/../app/config/Conexion.php';
require_once __DIR__ . '/../app/controllers/SeguimientoController.php';

$mensaje = '';

try {
    $conexion = Conexion::conectar();
    $controlador = new SeguimientoController($conexion);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mensaje = $controlador->registrar($_POST);
    }

} catch (PDOException $e) {
    http_response_code(500);
    $mensaje = 'Error al conectar con la base de datos.';
}

require_once __DIR__ . '/../app/views/seguimiento/registrar.php';

