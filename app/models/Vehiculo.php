<?php

require_once "app/config/Conn.php";

class Vehiculo{
    private $id;
    private $placa;
    private $modelo;
    private $disponible;

    public function __construct($placa="", $modelo="", $disponible=1, $id=0){
        $this->placa = $placa;
        $this->modelo = $modelo;
        $this->disponible = $disponible;
        $this->id = $id;
    }

    // guarda el vehiculo con su placa, modelo y si esta disponible, si se inserto bien devuelve true
    public function registrar(){
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "insert into vehiculo (placa, modelo, disponible) values (:placa, :modelo, :disponible)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':placa', $this->placa);
        $stmt->bindParam(':modelo', $this->modelo);
        $stmt->bindParam(':disponible', $this->disponible, PDO::PARAM_INT);
        $resultado = $stmt->execute();
        $conn->cerrar();
        return $resultado;
    }

    // trae todos los vehiculos de la tabla, no recibe nada y devuelve un arreglo con cada fila
    public function listar(){
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "select id, placa, modelo, disponible from vehiculo order by id";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $vehiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn->cerrar();
        return $vehiculos;
    }

    // trae solo los vehiculos libres (disponible = 1) para poder asignarlos, devuelve un arreglo
    public function listarDisponibles(){
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "select id, placa, modelo from vehiculo where disponible = 1 order by id";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $vehiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn->cerrar();
        return $vehiculos;
    }

    // busca un vehiculo por su id, devuelve la fila o false si no existe
    public function buscarPorId($id){
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "select id, placa, modelo, disponible from vehiculo where id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $vehiculo = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn->cerrar();
        return $vehiculo;
    }

    // cambia la placa, el modelo y si esta disponible, devuelve cuantas filas se modificaron
    public function actualizar(){
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "update vehiculo set placa = :placa, modelo = :modelo, disponible = :disponible where id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':placa', $this->placa);
        $stmt->bindParam(':modelo', $this->modelo);
        $stmt->bindParam(':disponible', $this->disponible, PDO::PARAM_INT);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $filas = $stmt->rowCount();
        $conn->cerrar();
        return $filas;
    }
}
