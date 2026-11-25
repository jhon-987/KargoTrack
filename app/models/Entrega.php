<?php

class Entrega
{
    private PDO $conexion;

    public function __construct(PDO $conexion)
    {
        $this->conexion = $conexion;
    }
    
    public function registrarEntrega(
        int $idEncomienda,
        string $receptor,
        string $observacion
    ): bool {
        $sql = "insert into entregas
                (id_encomienda, receptor, observacion)
                values (:id_encomienda, :receptor, :observacion)";

        $consulta = $this->conexion->prepare($sql);

        return $consulta->execute([
            ':id_encomienda' => $idEncomienda,
            ':receptor' => $receptor,
            ':observacion' => $observacion
        ]);
    }

    // dice si la encomienda existe, si ya tiene envio y si ya se entrego
    public function estadoEncomienda(int $idEncomienda): array|false
    {
        $sql = "select e.id_encomienda,
                       (select count(*) from envios v where v.id_encomienda = e.id_encomienda) as envios,
                       (select count(*) from entregas t where t.id_encomienda = e.id_encomienda) as entregas
                from encomiendas e
                where e.id_encomienda = :id_encomienda";

        $consulta = $this->conexion->prepare($sql);
        $consulta->execute([':id_encomienda' => $idEncomienda]);

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    // al entregar, el vehiculo del envio vuelve a estar disponible
    public function liberarVehiculo(int $idEncomienda): bool
    {
        $sql = "update vehiculo set disponible = 1
                where id = (select id_vehiculo from envios where id_encomienda = :id_encomienda)";

        $consulta = $this->conexion->prepare($sql);

        return $consulta->execute([':id_encomienda' => $idEncomienda]);
    }

    // deja el ultimo movimiento del historial como entregado
    public function registrarSeguimientoEntregado(int $idEncomienda): bool
    {
        $sql = "insert into seguimientos (id_encomienda, ubicacion, estado)
                select e.id_encomienda, e.destino, 'Entregado'
                from encomiendas e
                where e.id_encomienda = :id_encomienda";

        $consulta = $this->conexion->prepare($sql);

        return $consulta->execute([':id_encomienda' => $idEncomienda]);
    }

    public function consultarEntrega(int $idEncomienda): array|false
    {
        $sql = "select id_entrega, id_encomienda,
                       fecha_entrega, receptor, observacion
                from entregas
                where id_encomienda = :id_encomienda
                order by fecha_entrega desc
                limit 1";

        $consulta = $this->conexion->prepare($sql);

        $consulta->execute([
            ':id_encomienda' => $idEncomienda
        ]);

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }
}

