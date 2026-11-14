<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Encomienda</title>
</head>
<body>
    <h2>Registrar Nueva Encomienda</h2>
    <form action="?action=guardar_encomienda" method="POST">
        <div>
            <label for="cliente_id">Cliente Remitente:</label>
            <select id="cliente_id" name="cliente_id" required>
                <option value="">Seleccione un cliente</option>
                <?php foreach ($clientes as $cli): ?>
                    <option value="<?= htmlspecialchars($cli['id'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($cli['nombre'], ENT_QUOTES, 'UTF-8') ?> (DNI: <?= htmlspecialchars($cli['documento'], ENT_QUOTES, 'UTF-8') ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="peso">Peso (kg):</label>
            <input type="number" min="0.01" step="0.01" id="peso" name="peso" required>
        </div>
        <div>
            <label for="destino">Destino:</label>
            <input type="text" id="destino" name="destino" required>
        </div>
        <button type="submit">Guardar Encomienda</button>
    </form>
    <br>
    <a href="?action=listar_encomiendas">Ver listado de encomiendas</a>
</body>
</html>