<?php

require_once "app/models/Chofer.php";

class ChoferController{

    public function registrar(){
        $mensaje = "";
        if(!empty($_POST)){
            $nombre = trim($_POST["nombre"] ?? "");
            $licencia = strtoupper(trim($_POST["licencia"] ?? ""));

            if(empty($nombre) || empty($licencia)){
                $mensaje = "El nombre y la licencia son obligatorios";
            }else if(strlen($nombre) > 100){
                $mensaje = "El nombre no puede pasar de 100 caracteres";
            }else if(!preg_match("/^[A-Z][0-9]{8}$/", $licencia)){
                $mensaje = "La licencia debe tener una letra y 8 números, por ejemplo Q12345678";
            }else{
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
}
