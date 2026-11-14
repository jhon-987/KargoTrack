<?php
require_once "app/models/Vehiculo.php";

$vehiculo = new Vehiculo("DEF-321", "Mercedes Benz Actros", 1);
try{
    if($vehiculo->registrar()){
        echo "Se registró el vehículo DEF-321<br>";
    }
}catch(PDOException $e){
    echo "No se registró, ya existe esa placa en la tabla<br>";
}

$v = new Vehiculo();
$lista = $v->listar();
echo "Vehículos en la tabla: " . count($lista) . "<br>";
foreach($lista as $fila){
    echo $fila["id"] . " - " . $fila["placa"] . " - " . $fila["modelo"] . " - " . $fila["disponible"] . "<br>";
}
