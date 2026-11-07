<?php

require_once __DIR__ . '../app/models/Cliente.php';

class ClienteController {
    private $modelo;

    public function __construct($conexion) {
        $this->modelo = new Cliente($conexion);
    }

    public function mostrarFormulario() {
        require __DIR__ .'/../views/cliente/registro.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $documento = $_POST['documento'];
            $telefono = $_POST['telefono'];

            if ($this->modelo->registrar($nombre, $documento, $telefono)) {
                header('Location: /kargotrack/public/index.php?action=listar_clientes');
                exit();
            } else {
                echo "Error al registrar el cliente.";
            }
        } else {
            echo "Método de solicitud no válido.";
        }

        public function listar() {
            $clientes = $this->modelo->listar();
            require __DIR__ . '/../views/cliente/listar.php';
        }
    }
?>