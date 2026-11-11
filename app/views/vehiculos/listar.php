<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vehículos - KargoTrack</title>
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

    <h2>Lista de vehículos</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Placa</th>
            <th>Modelo</th>
            <th>Disponible</th>
        </tr>
        <?php foreach($vehiculos as $v){ ?>
        <tr>
            <td><?php echo $v["id"]; ?></td>
            <td><?php echo htmlspecialchars($v["placa"]); ?></td>
            <td><?php echo htmlspecialchars($v["modelo"]); ?></td>
            <td><?php echo $v["disponible"] == 1 ? "Sí" : "No"; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
