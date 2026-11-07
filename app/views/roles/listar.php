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
</head>
<body>

    <h1>KargoTrack</h1>
    <h2>Listado de roles</h2>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del rol</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $rol): ?>
                <tr>
                    <td><?= (int)$rol['id_rol'] ?></td>
                    <td><?= htmlspecialchars($rol['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($rol['descripcion'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>

    <a href="index.php?accion=login">Volver al inicio</a>

</body>
</html>
