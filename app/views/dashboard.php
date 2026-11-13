<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['idUsuario'])) {
    header('Location: index.php?accion=login');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - KargoTrack</title>
</head>
<body>

    <h1>Bienvenido a KargoTrack, <?php echo htmlspecialchars($_SESSION['nombre']); ?></h1>
    <p>Panel principal del sistema.</p>

    <hr>

    <h3>Menú:</h3>
    <ul>
        <li><a href="index.php?accion=listarUsuarios">Ver listado de usuarios</a></li>
        <li><a href="index.php?accion=formularioUsuario">Registrar nuevo usuario</a></li>
    </ul>

    <br>

    <a href="index.php?accion=logout">Cerrar Sesión</a>

</body>
</html>