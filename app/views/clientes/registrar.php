<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cliente - KargoTrack</title>
    <link rel="stylesheet" href="public/css/estilos_clientes.css">
</head>
<body class="client-form-body">

    <div class="client-form-container">
        <h2>KargoTrack</h2>
        <p>Registro de Nuevo Cliente</p>

        <?php if (!empty($error)): ?>
            <div class="alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="index.php?accion=guardarCliente" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" maxlength="100" required
                       value="<?php echo htmlspecialchars($datos['nombre'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" maxlength="100" required
                       value="<?php echo htmlspecialchars($datos['apellido'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="documento">Documento (DNI 8 dígitos o RUC 11 dígitos):</label>
                <input type="text" id="documento" name="documento" maxlength="11" pattern="\d{8}|\d{11}" required
                       value="<?php echo htmlspecialchars($datos['documento'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" maxlength="9" pattern="9\d{8}"
                       value="<?php echo htmlspecialchars($datos['telefono'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" maxlength="150"
                       value="<?php echo htmlspecialchars($datos['correo'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" maxlength="255"
                       value="<?php echo htmlspecialchars($datos['direccion'] ?? ''); ?>">
            </div>

            <button type="submit" class="btn-primary">Registrar Cliente</button>
        </form>

        <div class="link-container">
            <a href="index.php?accion=listarClientes" class="link-secondary">← Volver al listado</a>
        </div>
    </div>

</body>
</html>
