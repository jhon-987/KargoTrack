<?php
require_once __DIR__ . '/../models/Encomienda.php';
require_once __DIR__ . '/../models/Cliente.php';

class EncomiendaController {
    private $modelo;
    private $modeloCliente;
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
        $this->modelo = new Encomienda($conexion);
        $this->modeloCliente = new Cliente($conexion);
    }

    public function mostrarFormulario() {
        $clientes = $this->modeloCliente->listar();
        require __DIR__ . '/../views/Encomiendas/registro.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            return;
        }

        $clienteId = filter_input(INPUT_POST, 'cliente_id', FILTER_VALIDATE_INT);
        $peso = filter_input(INPUT_POST, 'peso', FILTER_VALIDATE_FLOAT);
        $destino = trim($_POST['destino'] ?? '');

        if (!$clienteId || !$peso || $peso <= 0 || $destino === '') {
            http_response_code(400);
            echo 'Completa correctamente todos los campos de la encomienda.';
            return;
        }

        $this->modelo->registrar($clienteId, $peso, $destino);
        header('Location: ?action=listar_encomiendas');
        exit();
    }

    public function listar() {
        $encomiendas = $this->modelo->listar();
        require __DIR__ . '/../views/encomiendas/listado.php';
    }
}
?>