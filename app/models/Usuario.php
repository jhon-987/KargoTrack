<?php

require_once __DIR__ . '/../config/Conexion.php';

class Usuario {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexion::getConnection();
    }

    public function registrar($nombre, $apellidos, $correo, $password, $id_rol) {
        $sql = "INSERT INTO usuarios (nombre, apellidos, correo, password, id_rol, estado) 
                VALUES (:nombre, :apellidos, :correo, :password, :id_rol, 1)";

        $stmt = $this->pdo->prepare($sql);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        return $stmt->execute([
            ':nombre' => $nombre,
            ':apellidos' => $apellidos,
            ':correo' => $correo,
            ':password' => $passwordHash,
            ':id_rol' => $id_rol
        ]);
    }

    public function buscarPorUsuario($correo) {
        $sql = "SELECT * FROM usuarios WHERE correo = :correo LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':correo' => $correo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listar() {
        $sql = "SELECT u.*, r.nombre AS rol_nombre 
                FROM usuarios u 
                INNER JOIN roles r ON u.id_rol = r.id_rol";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}