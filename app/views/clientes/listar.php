<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Clientes - KargoTrack</title>
    <link rel="stylesheet" href="public/css/estilos_clientes.css">
</head>
<body>

    <h2>Listado de Clientes</h2>

    <?php
    $mensajes = [
        'registrado' => ['ok', 'Cliente registrado correctamente.'],
        'actualizado' => ['ok', 'Cliente actualizado correctamente.'],
        'eliminado' => ['ok', 'Cliente eliminado correctamente.'],
        'noexiste' => ['error', 'El cliente no existe.'],
        'conencomiendas' => ['error', 'No se puede eliminar el cliente porque tiene encomiendas registradas.']
    ];
    ?>
    <?php if (!empty($mensaje) && isset($mensajes[$mensaje])): ?>
        <div class="alert-<?php echo $mensajes[$mensaje][0]; ?>"><?php echo $mensajes[$mensaje][1]; ?></div>
    <?php endif; ?>

    <p>
        <a href="index.php?accion=registroCliente">Registrar Nuevo Cliente</a> |
        <a href="index.php?accion=listarEncomiendas">Ver Encomiendas</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Documento</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($clientes)): ?>
                <?php foreach ($clientes as $c): ?>
                    <tr>
                        <td><?php echo (int) $c['id_cliente']; ?></td>
                        <td><?php echo htmlspecialchars($c['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($c['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($c['documento']); ?></td>
                        <td><?php echo htmlspecialchars($c['telefono'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($c['correo'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($c['direccion'] ?? ''); ?></td>
                        <td>
                            <a href="index.php?accion=editarCliente&id=<?php echo (int) $c['id_cliente']; ?>">Editar</a> |
                            <a href="index.php?accion=eliminarCliente&id=<?php echo (int) $c['id_cliente']; ?>" onclick="return confirm('¿Estás seguro de eliminar este cliente?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No hay clientes registrados.</td>
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
