<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Choferes - KargoTrack</title>
    <link rel="stylesheet" href="public/css/flota.css">
</head>
<body>
    <nav>
        <a href="vehiculos.php?accion=registrar">Registrar vehículo</a> |
        <a href="vehiculos.php">Lista de vehículos</a> |
        <a href="vehiculos.php?accion=disponibles">Vehículos disponibles</a> |
        <a href="choferes.php?accion=registrar">Registrar chofer</a> |
        <a href="choferes.php">Lista de choferes</a>
    </nav>

    <h2>Lista de choferes</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Licencia</th>
        </tr>
        <?php foreach($choferes as $c){ ?>
        <tr>
            <td><?php echo $c["id"]; ?></td>
            <td><?php echo htmlspecialchars($c["nombre"]); ?></td>
            <td><?php echo htmlspecialchars($c["licencia"]); ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
