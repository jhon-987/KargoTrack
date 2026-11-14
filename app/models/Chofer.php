<?php

require_once "app/config/Conn.php";

class Chofer{
    private $id;
    private $nombre;
    private $licencia;

    public function __construct($nombre="", $licencia="", $id=0){
        $this->nombre = $nombre;
        $this->licencia = $licencia;
        $this->id = $id;
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

    // busca un chofer por su id, devuelve la fila o false si no existe
    public function buscarPorId($id){
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "select id, nombre, licencia from chofer where id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $chofer = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn->cerrar();
        return $chofer;
    }

    // cambia el nombre y la licencia del chofer, devuelve cuantas filas se modificaron
    public function actualizar(){
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "update chofer set nombre = :nombre, licencia = :licencia where id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':licencia', $this->licencia);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $filas = $stmt->rowCount();
        $conn->cerrar();
        return $filas;
    }

    // borra al chofer con ese id, devuelve 1 si lo borro o 0 si no existia
    public function eliminar($id){
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "delete from chofer where id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $filas = $stmt->rowCount();
        $conn->cerrar();
        return $filas;
    }
}
