
<?php

require_once __DIR__ . '/../models/Envio.php';

class EnvioController {

    private $envio;

    public function __construct() {
        $this->envio = new Envio();
    }

    public function programarEnvio($id_encomienda, $id_ciudad_origen, $id_ciudad_destino, $id_vehiculo, $id_chofer, $fecha_salida, $fecha_llegada) {
        return $this->envio->programarEnvio($id_encomienda, $id_ciudad_origen, $id_ciudad_destino, $id_vehiculo, $id_chofer, $fecha_salida, $fecha_llegada);
    }

    public function listar() {
        return $this->envio->listar();
    }
}
