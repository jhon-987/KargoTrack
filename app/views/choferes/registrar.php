<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar chofer - KargoTrack</title>
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

    <h2>Registrar chofer</h2>

    <?php if(!empty($mensaje)){ ?>
        <p class="mensaje"><?php echo $mensaje; ?></p>
    <?php } ?>

    <form method="post" action="choferes.php?accion=registrar">
        <label>Nombre completo</label><br>
        <input type="text" name="nombre" placeholder="Carlos Ramirez Tucto" maxlength="100"><br>

        <label>Licencia</label><br>
        <input type="text" name="licencia" placeholder="Q12345678" maxlength="9"><br><br>

        <input type="submit" value="Guardar">
    </form>
</body>
</html>
