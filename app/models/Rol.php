<?php

require_once __DIR__ . '/../config/Conexion.php';

class Rol {

    private $pdo;

    public function __construct() {
        $conexion = new Conexion();
        $this->pdo = $conexion->getConnection();
    }

    public function listar() {
        $sql = "SELECT * FROM roles";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM roles WHERE id_rol = :id_rol";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}