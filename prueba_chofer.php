<?php
require_once "app/models/Chofer.php";

$chofer = new Chofer("Jorge Tarazona Leon", "Q83451276");
try{
    if($chofer->registrar()){
        echo "Se registró el chofer Jorge Tarazona Leon<br>";
    }
}catch(PDOException $e){
    echo "No se registró, ya existe esa licencia en la tabla<br>";
}

$c = new Chofer();
$lista = $c->listar();
echo "Choferes en la tabla: " . count($lista) . "<br>";
foreach($lista as $fila){
    echo $fila["id"] . " - " . $fila["nombre"] . " - " . $fila["licencia"] . "<br>";
}
