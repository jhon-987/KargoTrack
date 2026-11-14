<?php
require_once "app/models/Vehiculo.php";
require_once "app/models/Chofer.php";

// pruebo las funciones nuevas con un vehiculo y un chofer temporales, al final los borro

echo "<h3>Clase Vehiculo</h3>";
$v = new Vehiculo();
echo "listarDisponibles(): hay " . count($v->listarDisponibles()) . " vehículos disponibles<br>";

$nuevo = new Vehiculo("TMP-001", "Camion de prueba", 0);
try{
    $nuevo->registrar();
}catch(PDOException $e){
    echo "TMP-001 ya estaba registrado<br>";
}
$id = 0;
foreach($v->listar() as $fila){
    if($fila["placa"] == "TMP-001"){
        $id = $fila["id"];
    }
}
echo "Se registró el vehículo TMP-001 con id $id (no disponible)<br>";

$encontrado = $v->buscarPorId($id);
echo "buscarPorId($id): " . $encontrado["placa"] . " - " . $encontrado["modelo"] . "<br>";

$cambio = new Vehiculo("TMP-001", "Camion de prueba editado", 1, $id);
echo "actualizar(): filas modificadas = " . $cambio->actualizar() . "<br>";
$encontrado = $v->buscarPorId($id);
echo "Después de actualizar: " . $encontrado["modelo"] . ", disponible = " . $encontrado["disponible"] . "<br>";
echo "listarDisponibles(): ahora hay " . count($v->listarDisponibles()) . " vehículos disponibles<br>";

echo "eliminar($id): filas borradas = " . $v->eliminar($id) . "<br>";
echo "buscarPorId($id) después de eliminar: " . ($v->buscarPorId($id) === false ? "ya no existe" : "todavía existe") . "<br>";

echo "<h3>Clase Chofer</h3>";
$c = new Chofer();
$nuevo = new Chofer("Chofer de prueba", "T00000001");
try{
    $nuevo->registrar();
}catch(PDOException $e){
    echo "T00000001 ya estaba registrado<br>";
}
$id = 0;
foreach($c->listar() as $fila){
    if($fila["licencia"] == "T00000001"){
        $id = $fila["id"];
    }
}
echo "Se registró el chofer con licencia T00000001 e id $id<br>";

$encontrado = $c->buscarPorId($id);
echo "buscarPorId($id): " . $encontrado["nombre"] . " - " . $encontrado["licencia"] . "<br>";

$cambio = new Chofer("Chofer de prueba editado", "T00000001", $id);
echo "actualizar(): filas modificadas = " . $cambio->actualizar() . "<br>";
$encontrado = $c->buscarPorId($id);
echo "Después de actualizar: " . $encontrado["nombre"] . "<br>";

echo "eliminar($id): filas borradas = " . $c->eliminar($id) . "<br>";
echo "buscarPorId($id) después de eliminar: " . ($c->buscarPorId($id) === false ? "ya no existe" : "todavía existe") . "<br>";
