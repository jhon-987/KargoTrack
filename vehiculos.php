<?php
require_once "app/controllers/VehiculoController.php";

$accion = $_GET["accion"] ?? "listar";
$vc = new VehiculoController();

if($accion == "registrar"){
    $mensaje = $vc->registrar();
    require "app/views/vehiculos/registrar.php";
}else if($accion == "disponibles"){
    $vehiculos = $vc->listarDisponibles();
    require "app/views/vehiculos/disponibles.php";
}else if($accion == "editar"){
    $id = $_GET["id"] ?? "";
    $mensaje = $vc->actualizar($id);
    $vehiculo = $vc->buscar($id);
    require "app/views/vehiculos/editar.php";
}else{
    $vehiculos = $vc->listar();
    require "app/views/vehiculos/listar.php";
}
