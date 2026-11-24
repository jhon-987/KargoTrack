<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar chofer - KargoTrack</title>
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
        <h2>Registrar chofer</h2>

        <?php if(!empty($mensaje)){ ?>
            <p class="<?php echo strpos($mensaje, "correctamente") !== false ? "alerta-ok" : "alerta-error"; ?>"><?php echo $mensaje; ?></p>
        <?php } ?>

        <form method="post" action="choferes.php?accion=registrar" class="tarjeta formulario">
            <div class="campo">
                <label>Nombre completo</label>
                <input type="text" name="nombre" placeholder="Carlos Ramirez Tucto" maxlength="100">
            </div>

            <div class="campo">
                <label>Licencia</label>
                <input type="text" name="licencia" placeholder="Q12345678" maxlength="9">
            </div>

            <input type="submit" value="Guardar" class="btn">
        </form>
    </div>
</body>
</html>
