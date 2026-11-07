<?php

require_once "app/config/Conn.php";

class Chofer{
    private $id;
    private $nombre;
    private $licencia;

    public function __construct($nombre="", $licencia=""){
        $this->nombre = $nombre;
        $this->licencia = $licencia;
    }

    // registra al chofer con su nombre y su licencia, devuelve true cuando se guarda
    public function registrar(){
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "insert into chofer (nombre, licencia) values (:nombre, :licencia)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':licencia', $this->licencia);
        $resultado = $stmt->execute();
        $conn->cerrar();
        return $resultado;
    }

    // lista a todos los choferes registrados, no recibe parametros y devuelve un arreglo
    public function listar(){
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "select id, nombre, licencia from chofer order by id";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $choferes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn->cerrar();
        return $choferes;
    }
}
