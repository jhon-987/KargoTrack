<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Clientes - KargoTrack</title>
</head>
<body>

    <h2>Listado de Clientes</h2>

    <p><a href="index.php?accion=formularioCliente">Registrar Nuevo Cliente</a></p>

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
                        <td><?php echo $c['id_cliente']; ?></td>
                        <td><?php echo htmlspecialchars($c['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($c['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($c['documento']); ?></td>
                        <td><?php echo htmlspecialchars($c['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($c['correo']); ?></td>
                        <td><?php echo htmlspecialchars($c['direccion']); ?></td>
                        <td>
                            <a href="index.php?accion=editarCliente&id=<?php echo $c['id_cliente']; ?>">Editar</a> | 
                            <a href="index.php?accion=eliminarCliente&id=<?php echo $c['id_cliente']; ?>" onclick="return confirm('¿Estás seguro de eliminar este cliente?');">Eliminar</a>
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

    <br>
    <a href="index.php?accion=dashboardAdmin">Volver al Dashboard</a>

</body>
</html>