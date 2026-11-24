<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar vehículo - KargoTrack</title>
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
        <h2>Editar vehículo</h2>

        <?php if(!empty($mensaje)){ ?>
            <p class="<?php echo strpos($mensaje, "correctamente") !== false ? "alerta-ok" : "alerta-error"; ?>"><?php echo $mensaje; ?></p>
        <?php } ?>

        <?php if(!$vehiculo){ ?>
            <p class="alerta-error">No se encontró el vehículo que quieres editar</p>
            <a href="index.php?accion=listarVehiculos">Volver a la lista de vehículos</a>
        <?php }else{ ?>
            <form method="post" action="index.php?accion=editarVehiculo&id=<?php echo $vehiculo["id"]; ?>" class="tarjeta formulario">
                <div class="campo">
                    <label>ID</label>
                    <input type="text" value="<?php echo $vehiculo["id"]; ?>" disabled>
                </div>

                <div class="campo">
                    <label>Placa</label>
                    <input type="text" name="placa" value="<?php echo htmlspecialchars($vehiculo["placa"]); ?>" maxlength="7">
                </div>

                <div class="campo">
                    <label>Modelo</label>
                    <input type="text" name="modelo" value="<?php echo htmlspecialchars($vehiculo["modelo"]); ?>" maxlength="60">
                </div>

                <div class="campo">
                    <label>Disponible</label>
                    <select name="disponible">
                        <option value="1" <?php if($vehiculo["disponible"] == 1){ echo "selected"; } ?>>Sí</option>
                        <option value="0" <?php if($vehiculo["disponible"] == 0){ echo "selected"; } ?>>No</option>
                    </select>
                </div>

                <input type="submit" value="Guardar cambios" class="btn">
            </form>
        <?php } ?>
    </div>
</body>
</html>
