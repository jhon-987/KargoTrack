<?php

require_once "app/models/Vehiculo.php";

class VehiculoController{

    public function registrar(){
        $mensaje = "";
        if(!empty($_POST)){
            $placa = strtoupper(trim($_POST["placa"] ?? ""));
            $modelo = trim($_POST["modelo"] ?? "");
            $disponible = $_POST["disponible"] ?? "1";

            if(empty($placa) || empty($modelo)){
                $mensaje = "La placa y el modelo son obligatorios";
            }else if(!preg_match("/^[A-Z0-9]{3}-[0-9]{3}$/", $placa)){
                $mensaje = "La placa debe tener el formato ABC-123";
            }else if(strlen($modelo) > 60){
                $mensaje = "El modelo no puede pasar de 60 caracteres";
            }else{
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
}
