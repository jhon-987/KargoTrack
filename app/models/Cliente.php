<?php

require_once __DIR__ . '/../config/Conexion.php';

class Cliente {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::getConnection();
    }

    public function registrar($nombre, $apellido, $documento, $telefono, $correo, $direccion) {
        $sql = "INSERT INTO clientes (nombre, apellido, documento, telefono, correo, direccion) 
                VALUES (:nombre, :apellido, :documento, :telefono, :correo, :direccion)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':documento' => $documento,
            ':telefono' => $telefono,
            ':correo' => $correo,
            ':direccion' => $direccion
        ]);
    }

    public function listar() {
        $sql = "SELECT * FROM clientes";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}