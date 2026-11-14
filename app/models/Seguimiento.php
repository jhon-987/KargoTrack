
<?php

class Seguimiento
{
    private PDO $conexion;

    public function __construct(PDO $conexion)
    {
        $this->conexion = $conexion;
    }

   
    public function registrarActualizacion(
        int $idEncomienda,
        string $ubicacion,
        string $estado
    ): bool {
        $sql = "insert into seguimientos
                (id_encomienda, ubicacion, estado)
                values (:id_encomienda, :ubicacion, :estado)";

        $consulta = $this->conexion->prepare($sql);

        return $consulta->execute([
            ':id_encomienda' => $idEncomienda,
            ':ubicacion' => $ubicacion,
            ':estado' => $estado
        ]);
    }

 
    public function consultarHistorial(int $idEncomienda): array
    {
        $sql = "select id_seguimiento, id_encomienda,
                       fecha, ubicacion, estado
                from seguimientos
                where id_encomienda = :id_encomienda
                order by fecha desc, id_seguimiento desc";

        $consulta = $this->conexion->prepare($sql);

        $consulta->execute([
            ':id_encomienda' => $idEncomienda
        ]);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}

