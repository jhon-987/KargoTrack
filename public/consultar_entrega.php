
<?php

require_once __DIR__ . '/../app/config/Conexion.php';
require_once __DIR__ . '/../app/controllers/EntregaController.php';

$datosEntrega = false;
$mensajeError = '';

$idEncomienda = filter_var(
    $_GET['id_encomienda'] ?? null,
    FILTER_VALIDATE_INT
);

$idEncomienda = $idEncomienda ?: 0;

try {
    $conexion = Conexion::conectar();
    $controlador = new EntregaController($conexion);

    if ($idEncomienda > 0) {
        $datosEntrega = $controlador->consultar($idEncomienda);
    }

} catch (PDOException $e) {
    http_response_code(500);
    $mensajeError = 'No se pudo consultar la entrega.';
}

require_once __DIR__ . '/../app/views/entregas/consultar.php';

