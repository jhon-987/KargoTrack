
<?php

require_once __DIR__ . '/../config/conexion.php';

class Ciudad {

    private $conexion;

    public function __construct() {
        $db = new Conexion();
        $this->conexion = $db->conectar();
    }

    // Registra una ciudad en la base de datos
    public function registrar($nombre, $departamento) {
        $sql = "INSERT INTO ciudades (nombre, departamento) VALUES (?, ?)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$nombre, $departamento]);
    }

    // Lista todas las ciudades registradas
    public function listar() {
        $sql = "SELECT * FROM ciudades ORDER BY id_ciudad DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
