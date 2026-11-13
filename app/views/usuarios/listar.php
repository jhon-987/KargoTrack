<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Usuarios - KargoTrack</title>
</head>
<body>

    <h2>Listado de Usuarios</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($usuarios)): ?>
                <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td><?php echo $u['id_usuario']; ?></td>
                        <td><?php echo htmlspecialchars($u['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($u['apellidos']); ?></td>
                        <td><?php echo htmlspecialchars($u['correo']); ?></td>
                        <td><?php echo htmlspecialchars($u['rol_nombre']); ?></td>
                        <td><?php echo ($u['estado'] == 1) ? 'Activo' : 'Inactivo'; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No hay usuarios registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <br>
    <a href="index.php?accion=dashboard">Volver al Dashboard</a>

</body>
</html>