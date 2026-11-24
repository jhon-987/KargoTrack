<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vehículos disponibles - KargoTrack</title>
    <link rel="stylesheet" href="public/css/flota.css">
</head>
<body>
    <header class="barra">
        <h1>KargoTrack</h1>
        <nav>
            <a href="index.php?accion=<?php echo ($_SESSION["idRol"] ?? 1) == 1 ? "dashboardAdmin" : "dashboardOperador"; ?>">Panel principal</a>
            <a href="index.php?accion=registroVehiculo">Registrar vehículo</a>
            <a href="index.php?accion=listarVehiculos">Lista de vehículos</a>
            <a href="index.php?accion=vehiculosDisponibles">Vehículos disponibles</a>
            <a href="index.php?accion=registroChofer">Registrar chofer</a>
            <a href="index.php?accion=listarChoferes">Lista de choferes</a>
        </nav>
    </header>

    <div class="contenedor">
        <h2>Vehículos disponibles</h2>

        <?php if(count($vehiculos) == 0){ ?>
            <p class="alerta-error">No hay vehículos disponibles en este momento</p>
        <?php }else{ ?>
            <p class="total">Total de vehículos disponibles: <?php echo count($vehiculos); ?></p>
            <div class="tarjeta">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Placa</th>
                        <th>Modelo</th>
                    </tr>
                    <?php foreach($vehiculos as $v){ ?>
                    <tr>
                        <td><?php echo $v["id"]; ?></td>
                        <td><?php echo htmlspecialchars($v["placa"]); ?></td>
                        <td><?php echo htmlspecialchars($v["modelo"]); ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        <?php } ?>
    </div>
</body>
</html>
