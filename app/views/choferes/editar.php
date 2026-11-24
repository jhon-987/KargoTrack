<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar chofer - KargoTrack</title>
    <link rel="stylesheet" href="public/css/flota.css">
</head>
<body>
    <header class="barra">
        <h1>KargoTrack</h1>
        <nav>
            <a href="vehiculos.php?accion=registrar">Registrar vehículo</a>
            <a href="vehiculos.php">Lista de vehículos</a>
            <a href="vehiculos.php?accion=disponibles">Vehículos disponibles</a>
            <a href="choferes.php?accion=registrar">Registrar chofer</a>
            <a href="choferes.php">Lista de choferes</a>
        </nav>
    </header>

    <div class="contenedor">
        <h2>Editar chofer</h2>

        <?php if(!empty($mensaje)){ ?>
            <p class="<?php echo strpos($mensaje, "correctamente") !== false ? "alerta-ok" : "alerta-error"; ?>"><?php echo $mensaje; ?></p>
        <?php } ?>

        <?php if(!$chofer){ ?>
            <p class="alerta-error">No se encontró el chofer que quieres editar</p>
            <a href="choferes.php">Volver a la lista de choferes</a>
        <?php }else{ ?>
            <form method="post" action="choferes.php?accion=editar&id=<?php echo $chofer["id"]; ?>" class="tarjeta formulario">
                <div class="campo">
                    <label>ID</label>
                    <input type="text" value="<?php echo $chofer["id"]; ?>" disabled>
                </div>

                <div class="campo">
                    <label>Nombre completo</label>
                    <input type="text" name="nombre" value="<?php echo htmlspecialchars($chofer["nombre"]); ?>" maxlength="100">
                </div>

                <div class="campo">
                    <label>Licencia</label>
                    <input type="text" name="licencia" value="<?php echo htmlspecialchars($chofer["licencia"]); ?>" maxlength="9">
                </div>

                <input type="submit" value="Guardar cambios" class="btn">
            </form>
        <?php } ?>
    </div>
</body>
</html>
