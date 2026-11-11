<?php

require_once "app/models/Vehiculo.php";

class VehiculoController{

    // la uso al registrar y al editar para no repetir las mismas validaciones
    private function validar($placa, $modelo){
        if(empty($placa) || empty($modelo)){
            return "La placa y el modelo son obligatorios";
        }else if(!preg_match("/^[A-Z0-9]{3}-[0-9]{3}$/", $placa)){
            return "La placa debe tener el formato ABC-123";
        }else if(strlen($modelo) > 60){
            return "El modelo no puede pasar de 60 caracteres";
        }
        return "";
    }

    public function registrar(){
        $mensaje = "";
        if(!empty($_POST)){
            $placa = strtoupper(trim($_POST["placa"] ?? ""));
            $modelo = trim($_POST["modelo"] ?? "");
            $disponible = $_POST["disponible"] ?? "1";

            $mensaje = $this->validar($placa, $modelo);
            if($mensaje == ""){
                try{
                    $vehiculo = new Vehiculo($placa, $modelo, $disponible == "1" ? 1 : 0);
                    if($vehiculo->registrar()){
                        $mensaje = "Vehículo registrado correctamente";
                    }
                }catch(PDOException $e){
                    $mensaje = "No se pudo registrar, revisa que la placa no esté repetida";
                }
            }
        }
        return $mensaje;
    }

    public function listar(){
        $vehiculo = new Vehiculo();
        return $vehiculo->listar();
    }

    public function listarDisponibles(){
        $vehiculo = new Vehiculo();
        return $vehiculo->listarDisponibles();
    }

    public function buscar($id){
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if($id === false){
            return false;
        }
        $vehiculo = new Vehiculo();
        return $vehiculo->buscarPorId($id);
    }

    public function actualizar($id){
        $mensaje = "";
        if(!empty($_POST)){
            $id = filter_var($id, FILTER_VALIDATE_INT);
            $placa = strtoupper(trim($_POST["placa"] ?? ""));
            $modelo = trim($_POST["modelo"] ?? "");
            $disponible = $_POST["disponible"] ?? "1";

            $mensaje = $this->validar($placa, $modelo);
            if($id === false){
                $mensaje = "El ID del vehículo no es válido";
            }else if($mensaje == ""){
                try{
                    $vehiculo = new Vehiculo($placa, $modelo, $disponible == "1" ? 1 : 0, $id);
                    if($vehiculo->actualizar() > 0){
                        $mensaje = "Vehículo actualizado correctamente";
                    }else{
                        $mensaje = "No se hizo ningún cambio, los datos son los mismos";
                    }
                }catch(PDOException $e){
                    $mensaje = "No se pudo actualizar, revisa que la placa no esté repetida";
                }
            }
        }
        return $mensaje;
    }
}
