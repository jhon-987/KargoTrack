<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar vehículo - KargoTrack</title>
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

    <h2>Registrar vehículo</h2>

    <?php if(!empty($mensaje)){ ?>
        <p class="mensaje"><?php echo $mensaje; ?></p>
    <?php } ?>

    <form method="post" action="vehiculos.php?accion=registrar">
        <label>Placa</label><br>
        <input type="text" name="placa" placeholder="ABC-123" maxlength="7"><br>

        <label>Modelo</label><br>
        <input type="text" name="modelo" placeholder="Volvo FH 460" maxlength="60"><br>

        <label>Disponible</label><br>
        <select name="disponible">
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select><br><br>

        <input type="submit" value="Guardar">
    </form>
</body>
</html>
