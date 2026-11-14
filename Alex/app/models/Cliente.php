<?php
class Cliente {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    public function registrar($nombre, $documento, $telefono) {
        $query = "INSERT INTO clientes (nombre, documento, telefono) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$nombre, $documento, $telefono]);
    }

    public function listar() {
        $query = "SELECT * FROM clientes";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}