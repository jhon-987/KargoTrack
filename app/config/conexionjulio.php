<<<<<<< HEAD
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
=======

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

>>>>>>> 3aeef82cf5f235a7747fa484e17f4d23f6b76b4e
