<?php

require_once __DIR__ . '/../config/Conexion.php';

class Panel {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::getConnection();
    }

    // cuenta como van las encomiendas para mostrarlo en el panel
    public function resumen() {
        $sql = "SELECT
                    (SELECT COUNT(*) FROM encomiendas e
                     WHERE NOT EXISTS (SELECT 1 FROM envios v WHERE v.id_encomienda = e.id_encomienda)) AS pendientes,
                    (SELECT COUNT(*) FROM envios v
                     WHERE NOT EXISTS (SELECT 1 FROM entregas t WHERE t.id_encomienda = v.id_encomienda)) AS en_curso,
                    (SELECT COUNT(*) FROM entregas) AS entregadas,
                    (SELECT COUNT(*) FROM vehiculo WHERE disponible = 1) AS vehiculos_libres,
                    (SELECT COUNT(*) FROM clientes) AS clientes";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // las encomiendas mas antiguas que todavia no salen
    public function esperandoEnvio() {
        $sql = "SELECT e.id_encomienda, e.destino, e.peso, c.nombre, c.apellido
                FROM encomiendas e
                INNER JOIN clientes c ON e.cliente_id = c.id_cliente
                WHERE NOT EXISTS (SELECT 1 FROM envios v WHERE v.id_encomienda = e.id_encomienda)
                ORDER BY e.id_encomienda
                LIMIT 5";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // envios que ya salieron y aun no se entregan
    public function enCamino() {
        $sql = "SELECT v.id_encomienda, cd.nombre AS destino, ve.placa, ch.nombre AS chofer, v.fecha_llegada
                FROM envios v
                INNER JOIN ciudades cd ON v.id_ciudad_destino = cd.id_ciudad
                INNER JOIN vehiculo ve ON v.id_vehiculo = ve.id
                INNER JOIN chofer ch ON v.id_chofer = ch.id
                WHERE NOT EXISTS (SELECT 1 FROM entregas t WHERE t.id_encomienda = v.id_encomienda)
                ORDER BY v.fecha_llegada
                LIMIT 5";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
