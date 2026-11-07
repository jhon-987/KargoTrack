<?php

class Conexion {

    public function conectar() {
        $host = "127.0.0.1";
        $puerto = "3306";
        $db = "kargotrack";
       $usuario = "root";
        $password = "";

        try {
            $conexion = new PDO(
                "mysql:host=" .$host . ";
                port=" . $puerto . ";
                dbname=" . $db . "; 
                charset=utf8mb4", 
                $usuario, $password);
            
            return $conexion;
        } catch (PDOException $e) {
         die("Error de conexión: " . $e->getMessage());
        }
    }
}
