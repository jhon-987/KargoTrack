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

        <?php if (isset($error)): ?>
            <div class="alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="index.php?accion=guardarCliente" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required>
            </div>

            <div class="form-group">
                <label for="documento">Documento de Identidad (DNI):</label>
                <input type="text" id="documento" name="documento" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono">
            </div>

            <div class="form-group">
                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" name="correo">
            </div>

            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion">
            </div>

            <button type="submit" class="btn-primary">Registrar Cliente</button>
        </form>

        <div class="link-container">
            <a href="index.php?accion=listarClientes" class="link-secondary">← Volver al listado de clientes</a>
        </div>
    </div>

</body>
</html>