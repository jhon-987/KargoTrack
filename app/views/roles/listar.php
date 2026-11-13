<?php
$roles = $roles ?? [
    [
        'id_rol' => 1,
        'nombre' => 'Administrador',
        'descripcion' => 'Acceso administrativo al sistema'
    ],
    [
        'id_rol' => 2,
        'nombre' => 'Operativo',
        'descripcion' => 'Gestión operativa de encomiendas'
    ]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles - KargoTrack</title>
    <link rel="stylesheet" href="public/css/estilos_roles.css">
</head>
<body>

    <div class="container">
        <div class="top-actions">
            <h2>Gestion de roles</h2>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del rol</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($roles)): ?>
                    <?php foreach ($roles as $rol): ?>
                    <tr>
                        <td><span class="badge-id"><?php echo (int)$rol['id_rol'] ?></span></td>
                        <td><strong><?php echo htmlspecialchars($rol['nombre'], ENT_QUOTES, 'UTF-8'); ?></strong></td>
                        <td><p><?php echo htmlspecialchars($rol['descripcion'] ?? 'Sin descripción', ENT_QUOTES, 'UTF-8'); ?></p></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="empty-message">No hay roles registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="index.php?accion=dashboardAdmin" class="btn btn-secondary">Volver al Dashboard  </a>
    </div>

</body>
</html>
