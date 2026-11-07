<?php
require_once "app/controllers/VehiculoController.php";

$accion = $_GET["accion"] ?? "listar";
$vc = new VehiculoController();

if($accion == "registrar"){
    $mensaje = $vc->registrar();
    require "app/views/vehiculos/registrar.php";
}else{
    $vehiculos = $vc->listar();
    require "app/views/vehiculos/listar.php";
}
