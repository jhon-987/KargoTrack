
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

