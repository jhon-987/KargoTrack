
<?php

require_once __DIR__ . '/../models/Entrega.php';

class EntregaController
{
    private Entrega $modelo;

    public function __construct(PDO $conexion)
    {
        $this->modelo = new Entrega($conexion);
    }

    /**
     * Registra la entrega de una encomienda.
     * Recibe los datos del formulario.
     * Retorna un mensaje con el resultado.
     */
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

        $resultado = $this->modelo->registrarEntrega(
            $idEncomienda,
            $receptor,
            $observacion
        );

        return $resultado
            ? 'Entrega registrada correctamente.'
            : 'No se pudo registrar la entrega.';
    }

    /**
     * Consulta la entrega de una encomienda.
     * Recibe el ID de encomienda.
     * Retorna sus datos o false si no existe.
     */
    public function consultar(int $idEncomienda): array|false
    {
        if ($idEncomienda < 1) {
            return false;
        }

        return $this->modelo->consultarEntrega($idEncomienda);
    }
}

