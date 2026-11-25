<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Encomiendas - KargoTrack</title>
    <link rel="stylesheet" href="public/css/estilos_clientes.css">
</head>
<body>
    <h2>Encomiendas Registradas</h2>

    <?php
    $mensajes = [
        'registrada' => ['ok', 'Encomienda registrada correctamente.'],
        'actualizada' => ['ok', 'Encomienda actualizada correctamente.'],
        'eliminada' => ['ok', 'Encomienda eliminada correctamente.'],
        'noexiste' => ['error', 'La encomienda no existe.'],
        'noeditable' => ['error', 'No se puede editar una encomienda que ya tiene un envío programado.'],
        'noeliminable' => ['error', 'No se puede eliminar una encomienda que ya tiene un envío programado.']
    ];
    ?>
    <?php if (!empty($mensaje) && isset($mensajes[$mensaje])): ?>
        <div class="alert-<?php echo $mensajes[$mensaje][0]; ?>"><?php echo $mensajes[$mensaje][1]; ?></div>
    <?php endif; ?>

    <p>
        <a href="index.php?accion=registroEncomienda">Nueva encomienda</a> |
        <a href="index.php?accion=listarClientes">Ver clientes</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Documento</th>
                <th>Peso (kg)</th>
                <th>Destino</th>
                <th>Envío</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($encomiendas)): ?>
                <?php foreach ($encomiendas as $enc): ?>
                <tr>
                    <td><?php echo (int) $enc['id_encomienda']; ?></td>
                    <td><?php echo htmlspecialchars($enc['cliente_nombre'] . ' ' . $enc['cliente_apellido']); ?></td>
                    <td><?php echo htmlspecialchars($enc['cliente_documento']); ?></td>
                    <td><?php echo number_format((float) $enc['peso'], 2); ?></td>
                    <td><?php echo htmlspecialchars($enc['destino']); ?></td>
                    <td><?php if ($enc['tiene_entrega'] > 0) { echo 'Entregado'; } else if ($enc['tiene_envio'] > 0) { echo 'Programado'; } else { echo 'Pendiente'; } ?></td>
                    <td>
                        <?php if ($enc['tiene_envio'] == 0): ?>
                            <a href="index.php?accion=editarEncomienda&id=<?php echo (int) $enc['id_encomienda']; ?>">Editar</a> |
                            <a href="index.php?accion=eliminarEncomienda&id=<?php echo (int) $enc['id_encomienda']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta encomienda?');">Eliminar</a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No hay encomiendas registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php
    $rolDashboard = 'dashboardAdmin';

    if (isset($_SESSION['idRol']) && $_SESSION['idRol'] == 2) {
        $rolDashboard = 'dashboardOperador';
    }
    ?>
    <p><a href="index.php?accion=<?php echo $rolDashboard; ?>">Volver al Dashboard</a></p>
</body>
</html>
