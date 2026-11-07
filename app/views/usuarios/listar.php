<?php
$usuarios = [
    [
        'id_usuario' => 1,
        'nombre' => 'Carlos',
        'apellido' => 'Ramírez',
        'correo' => 'carlos@ejemplo.com',
        'rol' => 'Administrador',
        'estado' => 1
    ],
    [
        'id_usuario' => 2,
        'nombre' => 'Ana',
        'apellido' => 'Torres',
        'correo' => 'ana@ejemplo.com',
        'rol' => 'Operativo',
        'estado' => 1
    ]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
</head>
<body>

    <h1>KargoTrack</h1>
    <h2>Usuarios registrados</h2>

    <a href="index.php?accion=formularioUsuario">
        Registrar nuevo usuario
    </a>

    <br><br>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= (int)$usuario['id_usuario'] ?></td>
                    <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                    <td><?= htmlspecialchars($usuario['apellido']) ?></td>
                    <td><?= htmlspecialchars($usuario['correo']) ?></td>
                    <td><?= htmlspecialchars($usuario['rol']) ?></td>
                    <td>
                        <?= $usuario['estado'] == 1 ? 'Activo' : 'Inactivo' ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
