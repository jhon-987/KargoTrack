<?php
$host = 'localhost';
$dbname = 'kargotrack';
$username = 'root';
$password = '';
$conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>