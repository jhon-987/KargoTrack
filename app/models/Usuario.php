<?php

require_once __DIR__ . "../config/Conexion.php";

class Usuario {

    private $pdo;

    public function __construct() {
        $conexion = new Conexion();
        $this->pdo = $conexion->getConnection();
    }

    public function registrar($nombre, $apellido, $correo, $password, $id_rol) {
        $sql = "INSERT INTO usuarios (nombre, apellido, correo, password, id_rol) 
                VALUES (:nombre, :apellido, :correo, :password, :id_rol)";

        $stmt = $this->pdo->prepare($sql);

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        return $stmt->execute([
            $nombre => $nombre,
            $apellido => $apellido,
            $correo => $correo,
            $password => $passwordHash,
            $id_rol => $id_rol
            ]);

        return $stmt->execute();
    }

    public function buscarPorUsuario($correo) {
        $sql = "SELECT * FROM usuarios WHERE correo = :correo LIMIT 1";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':correo' => $correo
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }
}