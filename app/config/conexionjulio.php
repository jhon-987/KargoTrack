
<?php

class ConexionJulio {

    private static $host = "localhost";
    private static $dbname = "kargotrack_db";
    private static $username = "root";
    private static $password = "";

    public static function getConnection() {
        try {
            $conexion = new PDO(
                "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8mb4",
                self::$username,
                self::$password
            );

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conexion;

        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new RuntimeException("Error al conectar con la base de datos.");
        }
    }
}


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
