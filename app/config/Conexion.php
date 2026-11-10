<?php

class Conexion {

    private $host = "localhost";
    private $dbname = "kargotrack";
    private $username = "root";
    private $password = "";

    public function getConnection() {
        try {
            $conexion = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->username,
                $this->password
            );

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conexion;

        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new RuntimeException("Error al conectar con la base de datos.");
        }
    }
}