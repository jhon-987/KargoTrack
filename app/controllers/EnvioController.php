<?php

require_once __DIR__ . '/../models/Envio.php';
require_once __DIR__ . '/../models/Vehiculo.php';

class EnvioController {

    private $envio;
    private $vehiculo;

    public function __construct() {
        $this->envio = new Envio();
        $this->vehiculo = new Vehiculo();
    }

    // devuelve un mensaje de error, o vacio si se programo bien
    public function programarEnvio($id_encomienda, $id_ciudad_origen, $id_ciudad_destino, $id_vehiculo, $id_chofer, $fecha_salida, $fecha_llegada) {
        $id_encomienda = filter_var($id_encomienda, FILTER_VALIDATE_INT);
        $id_ciudad_origen = filter_var($id_ciudad_origen, FILTER_VALIDATE_INT);
        $id_ciudad_destino = filter_var($id_ciudad_destino, FILTER_VALIDATE_INT);
        $id_vehiculo = filter_var($id_vehiculo, FILTER_VALIDATE_INT);
        $id_chofer = filter_var($id_chofer, FILTER_VALIDATE_INT);

        if (!$id_encomienda || !$id_ciudad_origen || !$id_ciudad_destino || !$id_vehiculo || !$id_chofer || empty($fecha_salida) || empty($fecha_llegada)) {
            return 'Complete todos los campos del envío.';
        }
        if (!$this->envio->encomiendaSinEnvio($id_encomienda)) {
            return 'La encomienda no existe o ya tiene un envío programado.';
        }
        if (!$this->envio->existeCiudad($id_ciudad_origen) || !$this->envio->existeCiudad($id_ciudad_destino)) {
            return 'La ciudad de origen o de destino no existe.';
        }
        if ($id_ciudad_origen == $id_ciudad_destino) {
            return 'La ciudad de origen y la de destino no pueden ser la misma.';
        }
        $vehiculo = $this->vehiculo->buscarPorId($id_vehiculo);
        if (!$vehiculo || $vehiculo['disponible'] != 1) {
            return 'El vehículo no existe o no está disponible.';
        }
        if (!$this->envio->choferLibre($id_chofer)) {
            return 'El chofer no existe o ya tiene un envío en curso.';
        }
        if (strtotime($fecha_salida) === false || strtotime($fecha_llegada) === false) {
            return 'Las fechas no son válidas.';
        }
        if (strtotime($fecha_llegada) < strtotime($fecha_salida)) {
            return 'La fecha de llegada no puede ser antes que la fecha de salida.';
        }

        try {
            $this->envio->programarEnvio($id_encomienda, $id_ciudad_origen, $id_ciudad_destino, $id_vehiculo, $id_chofer, $fecha_salida, $fecha_llegada);
            $this->envio->ocuparVehiculo($id_vehiculo);
        } catch (PDOException $e) {
            return 'No se pudo programar el envío.';
        }
        return '';
    }

    public function listar() {
        return $this->envio->listar();
    }

    public function listarEncomiendasSinEnvio() {
        return $this->envio->listarEncomiendasSinEnvio();
    }

    // usa la consulta de vehiculos disponibles del modulo de vehiculos (rf-13)
    public function listarVehiculosDisponibles() {
        return $this->vehiculo->listarDisponibles();
    }

    public function listarChoferesLibres() {
        return $this->envio->listarChoferesLibres();
    }
}
