
<?php

class Conexion
{
    public static function conectar(): PDO
    {
        $host = 'localhost';
        $bd = 'kargotrack';
        $usuario = 'root';
        $clave = '';

        $dsn = "mysql:host=$host;dbname=$bd;charset=utf8mb4";

        return new PDO($dsn, $usuario, $clave, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
}

