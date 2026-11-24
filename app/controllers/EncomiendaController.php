<?php
require_once __DIR__ . '/../models/Encomienda.php';
require_once __DIR__ . '/../models/Cliente.php';

class EncomiendaController
{
    private $modelo;
    private $modeloCliente;

    public function __construct($conexion = null)
    {
        $this->modelo = new Encomienda($conexion);
        $this->modeloCliente = new Cliente($conexion);
    }

    public function mostrarFormulario()
    {
        $clientes = $this->modeloCliente->listar();
        $datos = [];
        require __DIR__ . '/../views/encomiendas/registro.php';
    }

    private function obtenerDatos()
    {
        return [
            'id_cliente' => trim($_POST['id_cliente'] ?? ''),
            'peso' => trim($_POST['peso'] ?? ''),
            'destino' => trim($_POST['destino'] ?? '')
        ];
    }

    // Devuelve el primer error encontrado o null si todo esta bien
    private function validar($datos)
    {
        if ($datos['id_cliente'] === '' || $datos['peso'] === '' || $datos['destino'] === '') {
            return 'Todos los campos de la encomienda son obligatorios.';
        }

        $idCliente = filter_var($datos['id_cliente'], FILTER_VALIDATE_INT);
        if (!$idCliente || !$this->modeloCliente->obtenerPorId($idCliente)) {
            return 'El cliente seleccionado no existe.';
        }

        $peso = filter_var($datos['peso'], FILTER_VALIDATE_FLOAT);
        if ($peso === false || $peso <= 0) {
            return 'El peso debe ser un número mayor que 0.';
        }

        if ($peso > 1000) {
            return 'El peso no puede ser mayor a 1000 kg.';
        }

        if (mb_strlen($datos['destino']) < 3 || mb_strlen($datos['destino']) > 150) {
            return 'El destino debe tener entre 3 y 150 caracteres.';
        }

        return null;
    }

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?accion=registroEncomienda');
            exit();
        }

        $datos = $this->obtenerDatos();
        $error = $this->validar($datos);

        if ($error === null) {
            $this->modelo->registrar(
                (int) $datos['id_cliente'],
                round((float) $datos['peso'], 2),
                $datos['destino']
            );
            header('Location: index.php?accion=listarEncomiendas&mensaje=registrada');
            exit();
        }

        $clientes = $this->modeloCliente->listar();
        require __DIR__ . '/../views/encomiendas/registro.php';
    }

    public function listar()
    {
        $encomiendas = $this->modelo->listar();
        $mensaje = $_GET['mensaje'] ?? '';
        require __DIR__ . '/../views/encomiendas/listado.php';
    }

    public function editar()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $encomienda = $id ? $this->modelo->obtenerPorId($id) : false;

        if (!$encomienda) {
            header('Location: index.php?accion=listarEncomiendas&mensaje=noexiste');
            exit();
        }

        // si ya tiene un envio programado ya no se puede editar
        if ($this->modelo->tieneEnvio($id)) {
            header('Location: index.php?accion=listarEncomiendas&mensaje=noeditable');
            exit();
        }

        $clientes = $this->modeloCliente->listar();
        $datos = $encomienda;
        $datos['id_cliente'] = $encomienda['cliente_id'];
        require __DIR__ . '/../views/encomiendas/editar.php';
    }

    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?accion=listarEncomiendas');
            exit();
        }

        $id = filter_input(INPUT_POST, 'id_encomienda', FILTER_VALIDATE_INT);

        if (!$id || !$this->modelo->obtenerPorId($id)) {
            header('Location: index.php?accion=listarEncomiendas&mensaje=noexiste');
            exit();
        }

        if ($this->modelo->tieneEnvio($id)) {
            header('Location: index.php?accion=listarEncomiendas&mensaje=noeditable');
            exit();
        }

        $datos = $this->obtenerDatos();
        $error = $this->validar($datos);

        if ($error === null) {
            $this->modelo->actualizar(
                $id,
                (int) $datos['id_cliente'],
                round((float) $datos['peso'], 2),
                $datos['destino']
            );
            header('Location: index.php?accion=listarEncomiendas&mensaje=actualizada');
            exit();
        }

        $clientes = $this->modeloCliente->listar();
        $datos['id_encomienda'] = $id;
        require __DIR__ . '/../views/encomiendas/editar.php';
    }

    public function eliminar()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id || !$this->modelo->obtenerPorId($id)) {
            header('Location: index.php?accion=listarEncomiendas&mensaje=noexiste');
            exit();
        }

        // si ya tiene un envio programado no se puede eliminar
        if ($this->modelo->tieneEnvio($id)) {
            header('Location: index.php?accion=listarEncomiendas&mensaje=noeliminable');
            exit();
        }

        $this->modelo->eliminar($id);

        header('Location: index.php?accion=listarEncomiendas&mensaje=eliminada');
        exit();
    }
}
