
<?php
$mensaje = $mensaje ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento de Encomiendas - KargoTrack</title>
</head>

<body>

<div class="contenedor">
    <h2>KargoTrack</h2>
    <p>Registro de seguimiento de encomiendas</p>

    <?php if ($mensaje !== ''): ?>
        <div class="mensaje">
            <?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="id_encomienda">ID de encomienda</label>
        <input
            type="number"
            id="id_encomienda"
            name="id_encomienda"
            min="1"
            required
            placeholder="Ejemplo: 1"
        >

        <label for="ubicacion">Ubicación actual</label>
        <input
            type="text"
            id="ubicacion"
            name="ubicacion"
            maxlength="150"
            required
            placeholder="Ejemplo: Huánuco"
        >

        <label for="estado">Estado de la encomienda</label>
        <select id="estado" name="estado" required>
            <option value="">Seleccione un estado</option>
            <option value="Registrado">Registrado</option>
            <option value="En tránsito">En tránsito</option>
            <option value="Recibido en destino">
                Recibido en destino
            </option>
            <option value="Entregado">Entregado</option>
        </select>

        <button type="submit">
            Registrar seguimiento
        </button>
    </form>
    <p>
        <a href="modulo5.php">Volver al menú del módulo 5</a>
    </p>
</div>

</body>
</html>

