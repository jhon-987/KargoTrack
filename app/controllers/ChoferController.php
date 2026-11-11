<?php

require_once "app/models/Chofer.php";

class ChoferController{

    // la uso al registrar y al editar para no repetir las mismas validaciones
    private function validar($nombre, $licencia){
        if(empty($nombre) || empty($licencia)){
            return "El nombre y la licencia son obligatorios";
        }else if(strlen($nombre) > 100){
            return "El nombre no puede pasar de 100 caracteres";
        }else if(!preg_match("/^[A-Z][0-9]{8}$/", $licencia)){
            return "La licencia debe tener una letra y 8 números, por ejemplo Q12345678";
        }
        return "";
    }

    public function registrar(){
        $mensaje = "";
        if(!empty($_POST)){
            $nombre = trim($_POST["nombre"] ?? "");
            $licencia = strtoupper(trim($_POST["licencia"] ?? ""));

            $mensaje = $this->validar($nombre, $licencia);
            if($mensaje == ""){
                try{
                    $chofer = new Chofer($nombre, $licencia);
                    if($chofer->registrar()){
                        $mensaje = "Chofer registrado correctamente";
                    }
                }catch(PDOException $e){
                    $mensaje = "No se pudo registrar, revisa que la licencia no esté repetida";
                }
            }
        }
        return $mensaje;
    }

    public function listar(){
        $chofer = new Chofer();
        return $chofer->listar();
    }

    public function buscar($id){
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if($id === false){
            return false;
        }
        $chofer = new Chofer();
        return $chofer->buscarPorId($id);
    }

    public function actualizar($id){
        $mensaje = "";
        if(!empty($_POST)){
            $id = filter_var($id, FILTER_VALIDATE_INT);
            $nombre = trim($_POST["nombre"] ?? "");
            $licencia = strtoupper(trim($_POST["licencia"] ?? ""));

            $mensaje = $this->validar($nombre, $licencia);
            if($id === false){
                $mensaje = "El ID del chofer no es válido";
            }else if($mensaje == ""){
                try{
                    $chofer = new Chofer($nombre, $licencia, $id);
                    if($chofer->actualizar() > 0){
                        $mensaje = "Chofer actualizado correctamente";
                    }else{
                        $mensaje = "No se hizo ningún cambio, los datos son los mismos";
                    }
                }catch(PDOException $e){
                    $mensaje = "No se pudo actualizar, revisa que la licencia no esté repetida";
                }
            }
        }
        return $mensaje;
    }
}
