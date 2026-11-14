<?php
class Encomienda {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    public function registrar($cliente_id, $peso, $destino) {
        $query = "INSERT INTO encomiendas (cliente_id, peso, destino) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$cliente_id, $peso, $destino]);
    }

    public function listar() {
        $query = "SELECT e.*, c.nombre as cliente_nombre 
                  FROM encomiendas e 
                  INNER JOIN clientes c ON e.cliente_id = c.id";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>