<?php

require_once __DIR__ . '/../models/Cliente.php';

class ClienteController {
    private $modelo;

    public function __construct($conexion) {
        $this->modelo = new Cliente($conexion);
    }

    public function mostrarFormulario() {
        require __DIR__ . '/../views/clientes/registro.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            return;
        }

        $nombre = trim($_POST['nombre'] ?? '');
        $documento = trim($_POST['documento'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');

        if ($nombre === '' || $documento === '' || $telefono === '') {
            http_response_code(400);
            echo 'Completa todos los campos del cliente.';
            return;
        }

        $this->modelo->registrar($nombre, $documento, $telefono);
        header('Location: ?action=listar_clientes');
        exit();
    }

    public function listar() {
        $clientes = $this->modelo->listar();
        require __DIR__ . '/../views/clientes/listado.php';
    }
}
?>