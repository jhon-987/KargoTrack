<?php
class Encomienda {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    public function registrar($id_cliente, $descripcion, $peso, $destino) {
        $query = "INSERT INTO encomiendas (id_cliente, descripcion, peso, destino, estado)
                  VALUES (?, ?, ?, ?, 'Registrado')";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id_cliente, $descripcion, $peso, $destino]);
    }

    public function listar() {
        $query = "SELECT e.id_encomienda, e.descripcion, e.peso, e.destino, e.estado,
                         c.nombre AS cliente_nombre, c.apellido AS cliente_apellido
                  FROM encomiendas e
                  LEFT JOIN clientes c ON e.id_cliente = c.id_cliente
                  ORDER BY e.id_encomienda DESC";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
