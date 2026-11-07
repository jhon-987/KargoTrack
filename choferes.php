<?php
require_once "app/controllers/ChoferController.php";

$accion = $_GET["accion"] ?? "listar";
$cc = new ChoferController();

if($accion == "registrar"){
    $mensaje = $cc->registrar();
    require "app/views/choferes/registrar.php";
}else{
    $choferes = $cc->listar();
    require "app/views/choferes/listar.php";
}
