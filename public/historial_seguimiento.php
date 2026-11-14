
<?php

require_once __DIR__ . '/../app/config/Conexion.php';
require_once __DIR__ . '/../app/controllers/SeguimientoController.php';

$historial = [];
$idEncomienda = filter_var(
    $_GET['id_encomienda'] ?? null,
    FILTER_VALIDATE_INT
);

$idEncomienda = $idEncomienda ?: 0;

try {
    $conexion = Conexion::conectar();
    $controlador = new SeguimientoController($conexion);

    if ($idEncomienda > 0) {
        $historial = $controlador->historial($idEncomienda);
    }

} catch (PDOException $e) {
    http_response_code(500);
    $mensajeError = 'No se pudo consultar el historial.';
}

require_once __DIR__ . '/../app/views/seguimiento/historial.php';

