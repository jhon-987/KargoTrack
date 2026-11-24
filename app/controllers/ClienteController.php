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
        $mensaje = $_GET['mensaje'] ?? '';
        require __DIR__ . '/../views/clientes/listar.php';
    }

    public function formulario()
    {
        $datos = [];
        require __DIR__ . '/../views/clientes/registrar.php';
    }

    public function mostrarFormulario()
    {
        $this->formulario();
    }

    // Toma los datos del formulario y les quita los espacios
    private function obtenerDatos()
    {
        return [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'apellido' => trim($_POST['apellido'] ?? ''),
            'documento' => trim($_POST['documento'] ?? ''),
            'telefono' => trim($_POST['telefono'] ?? ''),
            'correo' => trim($_POST['correo'] ?? ''),
            'direccion' => trim($_POST['direccion'] ?? '')
        ];
    }

    // Devuelve el primer error encontrado o null si todo esta bien
    private function validar($datos, $idExcluir = null)
    {
        if ($datos['nombre'] === '' || $datos['apellido'] === '' || $datos['documento'] === '') {
            return 'Nombre, apellido y documento son obligatorios.';
        }

        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ ]{2,100}$/u', $datos['nombre'])) {
            return 'El nombre solo debe tener letras (mínimo 2).';
        }

        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ ]{2,100}$/u', $datos['apellido'])) {
            return 'El apellido solo debe tener letras (mínimo 2).';
        }

        // DNI = 8 digitos, RUC = 11 digitos
        if (!preg_match('/^(\d{8}|\d{11})$/', $datos['documento'])) {
            return 'El documento debe ser un DNI de 8 dígitos o un RUC de 11 dígitos.';
        }

        if ($datos['telefono'] !== '' && !preg_match('/^9\d{8}$/', $datos['telefono'])) {
            return 'El teléfono debe tener 9 dígitos y empezar con 9.';
        }

        if ($datos['correo'] !== '' && !filter_var($datos['correo'], FILTER_VALIDATE_EMAIL)) {
            return 'El correo no tiene un formato válido.';
        }

        if (mb_strlen($datos['direccion']) > 255) {
            return 'La dirección es demasiado larga (máximo 255 caracteres).';
        }

        if ($this->cliente->existeDocumento($datos['documento'], $idExcluir)) {
            return 'Ya existe un cliente registrado con ese documento.';
        }

        return null;
    }

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?accion=formularioCliente');
            exit();
        }

        $datos = $this->obtenerDatos();
        $error = $this->validar($datos);

        if ($error === null) {
            $resultado = $this->cliente->registrar(
                $datos['nombre'],
                $datos['apellido'],
                $datos['documento'],
                $datos['telefono'],
                $datos['correo'],
                $datos['direccion']
            );

            if ($resultado) {
                header('Location: index.php?accion=listarClientes&mensaje=registrado');
                exit();
            }

            $error = 'No se pudo registrar el cliente.';
        }

        require __DIR__ . '/../views/clientes/registrar.php';
    }

    public function editar()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $c = $id ? $this->cliente->obtenerPorId($id) : false;

        if (!$c) {
            header('Location: index.php?accion=listarClientes&mensaje=noexiste');
            exit();
        }

        require __DIR__ . '/../views/clientes/editar.php';
    }

    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?accion=listarClientes');
            exit();
        }

        $id = filter_input(INPUT_POST, 'id_cliente', FILTER_VALIDATE_INT);

        if (!$id || !$this->cliente->obtenerPorId($id)) {
            header('Location: index.php?accion=listarClientes&mensaje=noexiste');
            exit();
        }

        $datos = $this->obtenerDatos();
        $error = $this->validar($datos, $id);

        if ($error === null) {
            $this->cliente->actualizar(
                $id,
                $datos['nombre'],
                $datos['apellido'],
                $datos['documento'],
                $datos['telefono'],
                $datos['correo'],
                $datos['direccion']
            );

            header('Location: index.php?accion=listarClientes&mensaje=actualizado');
            exit();
        }

        // si hay error se vuelve a mostrar el formulario con lo que escribio el usuario
        $c = $datos;
        $c['id_cliente'] = $id;
        require __DIR__ . '/../views/clientes/editar.php';
    }

    public function eliminar()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: index.php?accion=listarClientes');
            exit();
        }

        // no se elimina un cliente que ya tiene encomiendas registradas
        if ($this->cliente->tieneEncomiendas($id)) {
            header('Location: index.php?accion=listarClientes&mensaje=conencomiendas');
            exit();
        }

        $this->cliente->eliminar($id);

        header('Location: index.php?accion=listarClientes&mensaje=eliminado');
        exit();
    }
}
