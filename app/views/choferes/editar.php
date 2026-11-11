<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar chofer - KargoTrack</title>
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

    <h2>Editar chofer</h2>

    <?php if(!empty($mensaje)){ ?>
        <p class="mensaje"><?php echo $mensaje; ?></p>
    <?php } ?>

    <?php if(!$chofer){ ?>
        <p class="mensaje">No se encontró el chofer que quieres editar</p>
        <a href="choferes.php">Volver a la lista de choferes</a>
    <?php }else{ ?>
        <form method="post" action="choferes.php?accion=editar&id=<?php echo $chofer["id"]; ?>">
            <label>ID</label><br>
            <input type="text" value="<?php echo $chofer["id"]; ?>" disabled><br>

            <label>Nombre completo</label><br>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($chofer["nombre"]); ?>" maxlength="100"><br>

            <label>Licencia</label><br>
            <input type="text" name="licencia" value="<?php echo htmlspecialchars($chofer["licencia"]); ?>" maxlength="9"><br><br>

            <input type="submit" value="Guardar cambios">
        </form>
    <?php } ?>
</body>
</html>
