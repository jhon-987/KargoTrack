<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar vehículo - KargoTrack</title>
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

    <h2>Editar vehículo</h2>

    <?php if(!empty($mensaje)){ ?>
        <p class="mensaje"><?php echo $mensaje; ?></p>
    <?php } ?>

    <?php if(!$vehiculo){ ?>
        <p class="mensaje">No se encontró el vehículo que quieres editar</p>
        <a href="vehiculos.php">Volver a la lista de vehículos</a>
    <?php }else{ ?>
        <form method="post" action="vehiculos.php?accion=editar&id=<?php echo $vehiculo["id"]; ?>">
            <label>ID</label><br>
            <input type="text" value="<?php echo $vehiculo["id"]; ?>" disabled><br>

            <label>Placa</label><br>
            <input type="text" name="placa" value="<?php echo htmlspecialchars($vehiculo["placa"]); ?>" maxlength="7"><br>

            <label>Modelo</label><br>
            <input type="text" name="modelo" value="<?php echo htmlspecialchars($vehiculo["modelo"]); ?>" maxlength="60"><br>

            <label>Disponible</label><br>
            <select name="disponible">
                <option value="1" <?php if($vehiculo["disponible"] == 1){ echo "selected"; } ?>>Sí</option>
                <option value="0" <?php if($vehiculo["disponible"] == 0){ echo "selected"; } ?>>No</option>
            </select><br><br>

            <input type="submit" value="Guardar cambios">
        </form>
    <?php } ?>
</body>
</html>
