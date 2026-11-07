<?php

require_once __DIR__ . '/../../models/Rol.php';

$rol = new Rol();
$roles = $rol->listar();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
</head>
<body>

    <h1>KargoTrack</h1>
    <h2>Registro de usuarios</h2>

    <form action="index.php?accion=registrarUsuario" method="POST">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>

        <br><br>

        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="correo" required>

        <br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <br><br>

        <label for="id_rol">Rol:</label>
        <select id="id_rol" name="id_rol" required>
            <option value="">Seleccione un rol</option>

            <?php foreach ($roles as $item): ?>
                <option value="<?= (int)$item['id_rol'] ?>">
                    <?= htmlspecialchars($item['nombre'], ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>

        </select>

        <br><br>

        <button type="submit">Registrar usuario</button>

    </form>

    <br>

    <a href="index.php?accion=listarUsuarios">
        Ver usuarios registrados
    </a>

</body>
</html>