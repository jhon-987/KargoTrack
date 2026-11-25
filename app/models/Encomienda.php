<?php

require_once __DIR__ . '/../config/Conexion.php';

class Encomienda
{
    private $db;

    public function __construct($conexion = null)
    {
        $this->db = $conexion ?? Conexion::getConnection();
    }

    public function registrar($cliente_id, $peso, $destino)
    {
        $query = "INSERT INTO encomiendas (cliente_id, peso, destino) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$cliente_id, $peso, $destino]);
    }

    public function listar()
    {
        // tiene_envio indica si la encomienda ya fue asignada en el modulo de envios
        $query = "SELECT e.id_encomienda, e.cliente_id, e.peso, e.destino,
                         c.nombre AS cliente_nombre, c.apellido AS cliente_apellido,
                         c.documento AS cliente_documento,
                         (SELECT COUNT(*) FROM envios v WHERE v.id_encomienda = e.id_encomienda) AS tiene_envio,
                         (SELECT COUNT(*) FROM entregas t WHERE t.id_encomienda = e.id_encomienda) AS tiene_entrega
                  FROM encomiendas e
                  INNER JOIN clientes c ON e.cliente_id = c.id_cliente
                  ORDER BY e.id_encomienda DESC";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM encomiendas WHERE id_encomienda = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function tieneEnvio($id)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM envios WHERE id_encomienda = ?");
        $stmt->execute([$id]);
        return $stmt->fetchColumn() > 0;
    }

    public function actualizar($id, $cliente_id, $peso, $destino)
    {
        $query = "UPDATE encomiendas SET cliente_id = ?, peso = ?, destino = ? WHERE id_encomienda = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$cliente_id, $peso, $destino, $id]);
    }

    public function eliminar($id)
    {
        $stmt = $this->db->prepare("DELETE FROM encomiendas WHERE id_encomienda = ?");
        return $stmt->execute([$id]);
    }
}
