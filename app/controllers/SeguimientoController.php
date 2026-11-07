
<?php

require_once __DIR__ . '/../models/Seguimiento.php';

class SeguimientoController
{
    private Seguimiento $modelo;

    public function __construct(PDO $conexion)
    {
        $this->modelo = new Seguimiento($conexion);
    }

    /**
     * Registra una actualización de seguimiento.
     * Recibe los datos del formulario.
     * Retorna un mensaje con el resultado.
     */
    public function registrar(array $datos): string
    {
        $idEncomienda = filter_var(
            $datos['id_encomienda'] ?? null,
            FILTER_VALIDATE_INT
        );

        $ubicacion = trim($datos['ubicacion'] ?? '');
        $estado = trim($datos['estado'] ?? '');

        if (!$idEncomienda || $idEncomienda < 1 ||
            $ubicacion === '' || $estado === '') {
            return 'Complete todos los campos correctamente.';
        }

        $resultado = $this->modelo->registrarActualizacion(
            $idEncomienda,
            $ubicacion,
            $estado
        );

        return $resultado
            ? 'Seguimiento registrado correctamente.'
            : 'No se pudo registrar el seguimiento.';
    }

    /**
     * Consulta el historial de una encomienda.
     * Recibe el ID de encomienda.
     * Retorna un arreglo con sus movimientos.
     */
    public function historial(int $idEncomienda): array
    {
        if ($idEncomienda < 1) {
            return [];
        }

        return $this->modelo->consultarHistorial($idEncomienda);
    }
}

