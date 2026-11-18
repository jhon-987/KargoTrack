
<?php

require_once __DIR__ . '/../models/Cliente.php';

class ClienteController
{
    private $cliente;

    public function __construct($conexion = null)
    {
        $this->cliente = new Cliente($conexion);
    }

    public function listar()
    {
        $clientes = $this->cliente->listar();
        require __DIR__ . '/../views/clientes/listar.php';
    }

    public function formulario()
    {
        require __DIR__ . '/../views/clientes/registrar.php';
    }

    public function mostrarFormulario()
    {
        $this->formulario();
    }

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo 'Método no permitido.';
            return;
        }

        $nombre = trim($_POST['nombre'] ?? '');
        $apellido = trim($_POST['apellido'] ?? '');
        $documento = trim($_POST['documento'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');
        $correo = trim($_POST['correo'] ?? '');
        $direccion = trim($_POST['direccion'] ?? '');

        if ($nombre === '' || $documento === '' || $telefono === '') {
            http_response_code(400);
            echo 'Completa los campos obligatorios.';
            return;
        }

        $resultado = $this->cliente->registrar(
            $nombre,
            $apellido,
            $documento,
            $telefono,
            $correo,
            $direccion
        );

        if ($resultado) {
            header('Location: index.php?accion=listarClientes');
            exit();
        }

        $error = 'No se pudo registrar el cliente.';
        require __DIR__ . '/../views/clientes/registrar.php';
    }

    public function editar()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $c = $this->cliente->obtenerPorId($id);
            require __DIR__ . '/../views/clientes/editar.php';
            return;
        }

        header('Location: index.php?accion=listarClientes');
        exit();
    }

    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_cliente'] ?? '';
            $nombre = $_POST['nombre'] ?? '';
            $apellido = $_POST['apellido'] ?? '';
            $documento = $_POST['documento'] ?? '';
            $telefono = $_POST['telefono'] ?? '';
            $correo = $_POST['correo'] ?? '';
            $direccion = $_POST['direccion'] ?? '';

            $this->cliente->actualizar(
                $id,
                $nombre,
                $apellido,
                $documento,
                $telefono,
                $correo,
                $direccion
            );

            header('Location: index.php?accion=listarClientes');
            exit();
        }
    }

    public function eliminar()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->cliente->eliminar($id);
        }

        header('Location: index.php?accion=listarClientes');
        exit();
    }
}

