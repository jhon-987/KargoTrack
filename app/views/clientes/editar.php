<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente - KargoTrack</title>
    <link rel="stylesheet" href="public/css/estilos_clientes.css">
</head>
<body class="client-form-body">

    <div class="client-form-container">
        <h2>Editar Cliente</h2>

        <?php if (!empty($error)): ?>
            <div class="alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="index.php?accion=actualizarCliente" method="POST">
            <input type="hidden" name="id_cliente" value="<?php echo (int) $c['id_cliente']; ?>">

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" maxlength="100" required
                       value="<?php echo htmlspecialchars($c['nombre'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" maxlength="100" required
                       value="<?php echo htmlspecialchars($c['apellido'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="documento">Documento (DNI 8 dígitos o RUC 11 dígitos):</label>
                <input type="text" id="documento" name="documento" maxlength="11" pattern="\d{8}|\d{11}" required
                       value="<?php echo htmlspecialchars($c['documento'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" maxlength="9" pattern="9\d{8}"
                       value="<?php echo htmlspecialchars($c['telefono'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" maxlength="150"
                       value="<?php echo htmlspecialchars($c['correo'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" maxlength="255"
                       value="<?php echo htmlspecialchars($c['direccion'] ?? ''); ?>">
            </div>

            <button type="submit" class="btn-primary">Actualizar Cliente</button>
        </form>

        <div class="link-container">
            <a href="index.php?accion=listarClientes" class="link-secondary">← Volver al listado</a>
        </div>
    </div>

</body>
</html>
