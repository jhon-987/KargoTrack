<?php

require_once __DIR__ . '/../config/Conexion.php';

class Cliente
{
    private $pdo;

    public function __construct($conexion = null)
    {
        $this->pdo = $conexion ?? Conexion::getConnection();
    }

    public function registrar($nombre, $apellido, $documento, $telefono, $correo, $direccion)
    {
        $sql = "INSERT INTO clientes (nombre, apellido, documento, telefono, correo, direccion)
                VALUES (:nombre, :apellido, :documento, :telefono, :correo, :direccion)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':documento' => $documento,
            ':telefono' => $telefono !== '' ? $telefono : null,
            ':correo' => $correo !== '' ? $correo : null,
            ':direccion' => $direccion !== '' ? $direccion : null
        ]);
    }

    public function listar()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clientes ORDER BY id_cliente DESC");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM clientes WHERE id_cliente = :id"
        );

        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Verifica si el documento ya esta registrado (al editar se excluye el mismo cliente)
    public function existeDocumento($documento, $idExcluir = null)
    {
        $sql = "SELECT COUNT(*) FROM clientes WHERE documento = :documento";
        $params = [':documento' => $documento];

        if ($idExcluir !== null) {
            $sql .= " AND id_cliente <> :id";
            $params[':id'] = $idExcluir;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchColumn() > 0;
    }

    public function tieneEncomiendas($id)
    {
        $stmt = $this->pdo->prepare(
            "SELECT COUNT(*) FROM encomiendas WHERE cliente_id = :id"
        );
        $stmt->execute([':id' => $id]);

        return $stmt->fetchColumn() > 0;
    }

    public function actualizar($id, $nombre, $apellido, $documento, $telefono, $correo, $direccion)
    {
        $sql = "UPDATE clientes
                SET nombre = :nombre,
                    apellido = :apellido,
                    documento = :documento,
                    telefono = :telefono,
                    correo = :correo,
                    direccion = :direccion
                WHERE id_cliente = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':documento' => $documento,
            ':telefono' => $telefono !== '' ? $telefono : null,
            ':correo' => $correo !== '' ? $correo : null,
            ':direccion' => $direccion !== '' ? $direccion : null
        ]);
    }

    public function eliminar($id)
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM clientes WHERE id_cliente = :id"
        );

        return $stmt->execute([':id' => $id]);
    }
}
