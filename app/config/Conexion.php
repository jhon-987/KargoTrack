<?php

class Conexion
{
    private static $host = 'localhost';
    private static $dbname = 'kargotrack';
    private static $username = 'root';
    private static $password = '';

    public static function getConnection(): PDO
    {
        return self::conectar();
    }

    public static function conectar(): PDO
    {
        $dsn = 'mysql:host=' . self::$host .
               ';dbname=' . self::$dbname .
               ';charset=utf8mb4';

        return new PDO(
            $dsn,
            self::$username,
            self::$password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }
}
