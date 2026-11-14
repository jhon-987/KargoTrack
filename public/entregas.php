
<?php

require_once __DIR__ . '/../app/config/Conexion.php';
require_once __DIR__ . '/../app/controllers/EntregaController.php';

$mensaje = '';

try {
    $conexion = Conexion::conectar();
    $controlador = new EntregaController($conexion);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mensaje = $controlador->registrar($_POST);
    }

} catch (PDOException $e) {
    http_response_code(500);
    $mensaje = 'Error al conectar o guardar en la base de datos.';
}

require_once __DIR__ . '/../app/views/entregas/registrar.php';

