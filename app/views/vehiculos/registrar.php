<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar vehículo - KargoTrack</title>
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
        <h2>Registrar vehículo</h2>

        <?php if(!empty($mensaje)){ ?>
            <p class="<?php echo strpos($mensaje, "correctamente") !== false ? "alerta-ok" : "alerta-error"; ?>"><?php echo $mensaje; ?></p>
        <?php } ?>

        <form method="post" action="vehiculos.php?accion=registrar" class="tarjeta formulario">
            <div class="campo">
                <label>Placa</label>
                <input type="text" name="placa" placeholder="ABC-123" maxlength="7">
            </div>

            <div class="campo">
                <label>Modelo</label>
                <input type="text" name="modelo" placeholder="Volvo FH 460" maxlength="60">
            </div>

            <div class="campo">
                <label>Disponible</label>
                <select name="disponible">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <input type="submit" value="Guardar" class="btn">
        </form>
    </div>
</body>
</html>
