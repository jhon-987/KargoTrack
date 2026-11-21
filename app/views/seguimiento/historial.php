
<?php
$historial = $historial ?? [];
$idEncomienda = $idEncomienda ?? 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de seguimiento - KargoTrack</title>
</head>
<body>

<div class="contenedor">
    <h2>KargoTrack</h2>
    <p>Historial de seguimiento de encomiendas</p>

    <form method="GET" action="">
        <input
            type="number"
            name="id_encomienda"
            min="1"
            required
            placeholder="Ingrese el ID de encomienda"
            value="<?= $idEncomienda > 0 ? (int)$idEncomienda : '' ?>"
        >
        <button type="submit">Buscar historial</button>
    </form>

    <div class="tabla">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Encomienda</th>
                    <th>Fecha</th>
                    <th>Ubicación</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($historial)): ?>
                    <tr>
                        <td colspan="5" class="vacio">
                            No hay movimientos para mostrar.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($historial as $registro): ?>
                        <tr>
                            <td><?= (int)$registro['id_seguimiento'] ?></td>
                            <td><?= (int)$registro['id_encomienda'] ?></td>
                            <td><?= htmlspecialchars($registro['fecha'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($registro['ubicacion'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($registro['estado'], ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <p>
    <a href="seguimiento.php">Registrar nuevo seguimiento</a>
</p>

<p>
    <a href="modulo5.php">Volver al menú del módulo 5</a>
</p>
</div>

</body>
</html>

