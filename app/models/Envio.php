
<?php

require_once __DIR__ . '/../config/conexion.php';

class Envio {

    private $conexion;

    public function __construct() {
        $db = new Conexion();
        $this->conexion = $db->conectar();
    }

    // Programa un envio en la base de datos
    public function programarEnvio($id_encomienda, $id_ciudad_origen, $id_ciudad_destino, $id_vehiculo, $id_chofer, $fecha_salida, $fecha_llegada) {
        $sql = "INSERT INTO envios (id_encomienda, id_ciudad_origen, id_ciudad_destino, id_vehiculo, id_chofer, fecha_salida, fecha_llegada) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$id_encomienda, $id_ciudad_origen, $id_ciudad_destino, $id_vehiculo, $id_chofer, $fecha_salida, $fecha_llegada]);
    }

    // Lista todos los envios registrados
    public function listar() {
        $sql = "SELECT * FROM envios ORDER BY id_envio DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
