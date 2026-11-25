<?php

require_once __DIR__ . '/../models/Entrega.php';

class EntregaController
{
    private Entrega $modelo;

    public function __construct(PDO $conexion)
    {
        $this->modelo = new Entrega($conexion);
    }

    public function registrar(array $datos): string
    {
        $idEncomienda = filter_var(
            $datos['id_encomienda'] ?? null,
            FILTER_VALIDATE_INT
        );

        $receptor = trim($datos['receptor'] ?? '');
        $observacion = trim($datos['observacion'] ?? '');

        if (!$idEncomienda || $idEncomienda < 1 ||
            $receptor === '') {
            return 'Ingrese una encomienda válida y el nombre del receptor.';
        }

        $estadoActual = $this->modelo->estadoEncomienda($idEncomienda);
        if (!$estadoActual) {
            return 'No existe una encomienda con ese número.';
        }
        if ($estadoActual['envios'] == 0) {
            return 'La encomienda todavía no tiene un envío, no se puede entregar.';
        }
        if ($estadoActual['entregas'] > 0) {
            return 'Esta encomienda ya fue entregada.';
        }

        $resultado = $this->modelo->registrarEntrega(
            $idEncomienda,
            $receptor,
            $observacion
        );

        if ($resultado) {
            $this->modelo->liberarVehiculo($idEncomienda);
            $this->modelo->registrarSeguimientoEntregado($idEncomienda);
        }

        return $resultado
            ? 'Entrega registrada correctamente.'
            : 'No se pudo registrar la entrega.';
    }

    public function consultar(int $idEncomienda): array|false
    {
        if ($idEncomienda < 1) {
            return false;
        }

        return $this->modelo->consultarEntrega($idEncomienda);
    }
}