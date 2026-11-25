<?php

require_once __DIR__ . '/../config/Conexion.php';

class Envio {

    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::conectar();
    }

    // Programa un envio en la base de datos
    public function programarEnvio($id_encomienda, $id_ciudad_origen, $id_ciudad_destino, $id_vehiculo, $id_chofer, $fecha_salida, $fecha_llegada) {
        $sql = "INSERT INTO envios (id_encomienda, id_ciudad_origen, id_ciudad_destino, id_vehiculo, id_chofer, fecha_salida, fecha_llegada) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$id_encomienda, $id_ciudad_origen, $id_ciudad_destino, $id_vehiculo, $id_chofer, $fecha_salida, $fecha_llegada]);
    }

    // lista los envios con los nombres en vez de los ids
    public function listar() {
        $sql = "SELECT v.id_envio, v.id_encomienda, v.fecha_salida, v.fecha_llegada,
                       co.nombre AS origen, cd.nombre AS destino,
                       ve.placa, ch.nombre AS chofer,
                       c.nombre AS cliente_nombre, c.apellido AS cliente_apellido,
                       (SELECT COUNT(*) FROM entregas t WHERE t.id_encomienda = v.id_encomienda) AS entregado
                FROM envios v
                INNER JOIN ciudades co ON v.id_ciudad_origen = co.id_ciudad
                INNER JOIN ciudades cd ON v.id_ciudad_destino = cd.id_ciudad
                INNER JOIN vehiculo ve ON v.id_vehiculo = ve.id
                INNER JOIN chofer ch ON v.id_chofer = ch.id
                INNER JOIN encomiendas e ON v.id_encomienda = e.id_encomienda
                INNER JOIN clientes c ON e.cliente_id = c.id_cliente
                ORDER BY v.id_envio DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // encomiendas que todavia no tienen envio, para el select del formulario
    public function listarEncomiendasSinEnvio() {
        $sql = "SELECT e.id_encomienda, e.destino, c.nombre, c.apellido
                FROM encomiendas e
                INNER JOIN clientes c ON e.cliente_id = c.id_cliente
                WHERE NOT EXISTS (SELECT 1 FROM envios v WHERE v.id_encomienda = e.id_encomienda)
                ORDER BY e.id_encomienda";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function encomiendaSinEnvio($id_encomienda) {
        $sql = "SELECT COUNT(*) FROM encomiendas e
                WHERE e.id_encomienda = ?
                AND NOT EXISTS (SELECT 1 FROM envios v WHERE v.id_encomienda = e.id_encomienda)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$id_encomienda]);
        return $stmt->fetchColumn() > 0;
    }

    public function existeCiudad($id_ciudad) {
        $stmt = $this->conexion->prepare("SELECT COUNT(*) FROM ciudades WHERE id_ciudad = ?");
        $stmt->execute([$id_ciudad]);
        return $stmt->fetchColumn() > 0;
    }

    // un chofer esta ocupado si tiene un envio que todavia no se entrega
    public function listarChoferesLibres() {
        $sql = "SELECT ch.id, ch.nombre, ch.licencia
                FROM chofer ch
                WHERE NOT EXISTS (
                    SELECT 1 FROM envios v
                    WHERE v.id_chofer = ch.id
                    AND NOT EXISTS (SELECT 1 FROM entregas t WHERE t.id_encomienda = v.id_encomienda)
                )
                ORDER BY ch.nombre";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function choferLibre($id_chofer) {
        $sql = "SELECT COUNT(*) FROM chofer ch
                WHERE ch.id = ?
                AND NOT EXISTS (
                    SELECT 1 FROM envios v
                    WHERE v.id_chofer = ch.id
                    AND NOT EXISTS (SELECT 1 FROM entregas t WHERE t.id_encomienda = v.id_encomienda)
                )";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$id_chofer]);
        return $stmt->fetchColumn() > 0;
    }

    // cuando sale el envio el vehiculo deja de estar disponible
    public function ocuparVehiculo($id_vehiculo) {
        $stmt = $this->conexion->prepare("UPDATE vehiculo SET disponible = 0 WHERE id = ?");
        return $stmt->execute([$id_vehiculo]);
    }
}
