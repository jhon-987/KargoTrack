<?php

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="public/css/estilos_usuarios.css">
</head>
<body class="form-body">

    <div class="form-container">

        <h2>KargoTrack</h2>
        <p>Registro de usuarios</p>

        <?php if (isset($error)): ?>
            <div class="alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="index.php?accion=registrarUsuario" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required>
            </div>

            <div class="form-group">
                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="id_rol">Rol:</label>
                <select id="id_rol" name="id_rol" required>
                    <option value="">Seleccione un rol</option>
                    <?php if (!empty($roles)): ?>
                        <?php foreach ($roles as $item): ?>
                            <option value="<?= (int)$item['id_rol'] ?>">
                                <?= htmlspecialchars($item['nombre'], ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <button type="submit" class="btn-primary">Registrar usuario</button>
        </form>

        <div class="link-container">
            <a href="index.php?accion=dashboardAdmin" class="link-secondary">← Volver</a>
        </div>

    </div>

</body>
</html>