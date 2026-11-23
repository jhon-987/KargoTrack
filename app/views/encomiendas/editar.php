<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Encomienda - KargoTrack</title>
    <link rel="stylesheet" href="public/css/estilos_clientes.css">
</head>
<body class="client-form-body">

    <div class="client-form-container">
        <h2>Editar Encomienda #<?php echo (int) $datos['id_encomienda']; ?></h2>

        <?php if (!empty($error)): ?>
            <div class="alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="index.php?accion=actualizarEncomienda" method="POST">
            <input type="hidden" name="id_encomienda" value="<?php echo (int) $datos['id_encomienda']; ?>">

            <div class="form-group">
                <label for="id_cliente">Cliente remitente:</label>
                <select id="id_cliente" name="id_cliente" required>
                    <option value="">Seleccione un cliente</option>
                    <?php foreach ($clientes as $cli): ?>
                        <option value="<?php echo (int) $cli['id_cliente']; ?>"
                            <?php echo (($datos['id_cliente'] ?? '') == $cli['id_cliente']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cli['nombre'] . ' ' . $cli['apellido']); ?>
                            (Doc: <?php echo htmlspecialchars($cli['documento']); ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="peso">Peso (kg):</label>
                <input type="number" id="peso" name="peso" min="0.01" max="1000" step="0.01" required
                       value="<?php echo htmlspecialchars($datos['peso'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="destino">Destino:</label>
                <input type="text" id="destino" name="destino" minlength="3" maxlength="150" required
                       value="<?php echo htmlspecialchars($datos['destino'] ?? ''); ?>">
            </div>

            <button type="submit" class="btn-primary">Actualizar Encomienda</button>
        </form>

        <div class="link-container">
            <a href="index.php?accion=listarEncomiendas" class="link-secondary">← Volver al listado</a>
        </div>
    </div>

</body>
</html>
