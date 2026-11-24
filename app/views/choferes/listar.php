<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Choferes - KargoTrack</title>
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
        <h2>Lista de choferes</h2>

        <?php if(!empty($mensaje)){ ?>
            <p class="<?php echo strpos($mensaje, "correctamente") !== false ? "alerta-ok" : "alerta-error"; ?>"><?php echo $mensaje; ?></p>
        <?php } ?>

        <div class="tarjeta">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Licencia</th>
                    <th>Acciones</th>
                </tr>
                <?php foreach($choferes as $c){ ?>
                <tr>
                    <td><?php echo $c["id"]; ?></td>
                    <td><?php echo htmlspecialchars($c["nombre"]); ?></td>
                    <td><?php echo htmlspecialchars($c["licencia"]); ?></td>
                    <td>
                        <a href="index.php?accion=editarChofer&id=<?php echo $c["id"]; ?>" class="btn btn-chico">Editar</a>
                        <form method="post" action="index.php?accion=eliminarChofer" class="en-linea" onsubmit="return confirm('¿Seguro que quieres eliminar este chofer?');">
                            <input type="hidden" name="id" value="<?php echo $c["id"]; ?>">
                            <input type="submit" value="Eliminar" class="btn btn-chico btn-eliminar">
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>
