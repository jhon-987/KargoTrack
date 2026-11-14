<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Usuarios - KargoTrack</title>
    <link rel="stylesheet" href="public/css/estilos_roles.css">
</head>
<body>

    <div class="container">
        <div class="top-actions">
            <h2>Listado de Usuarios</h2>
        </div>

        <table>
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
                            <td><span class="badge-id"><?php echo $u['id_usuario']; ?></span></td>
                            <td><?php echo htmlspecialchars($u['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($u['apellidos']); ?></td>
                            <td><?php echo htmlspecialchars($u['correo']); ?></td>
                            <td><strong><?php echo htmlspecialchars($u['rol_nombre']); ?></strong></td>
                            <td>
                                <span>
                                    <?php echo ($u['estado'] == 1) ? 'Activo' : 'Inactivo'; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="empty-message">No hay usuarios registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="index.php?accion=dashboardAdmin" class="btn btn-secondary">Volver al Dashboard</a>
    </div>

</body>
</html>