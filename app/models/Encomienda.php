<?php
class Encomienda {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    public function registrar($cliente_id, $peso, $destino) {
        $query = "INSET INTO encomiendas (cliente_id, peso, destino) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$cliente_id, $peso, $destino]);
    }

    public function listar() {
        $query = "SELECT * FROM encomiendas";
        $stmt = $this->db->query($query);
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }
}