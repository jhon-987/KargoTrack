<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente - KargoTrack</title>
</head>
<body>

    <h2>Editar Cliente</h2>

    <form action="index.php?accion=actualizarCliente" method="POST">
        <input type="hidden" name="id_cliente" value="<?php echo $c['id_cliente']; ?>">

        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($c['nombre']); ?>" required><br><br>

        <label>Apellido:</label><br>
        <input type="text" name="apellido" value="<?php echo htmlspecialchars($c['apellido']); ?>" required><br><br>

        <label>Documento:</label><br>
        <input type="text" name="documento" value="<?php echo htmlspecialchars($c['documento']); ?>" required><br><br>

        <label>Teléfono:</label><br>
        <input type="text" name="telefono" value="<?php echo htmlspecialchars($c['telefono']); ?>"><br><br>

        <label>Correo:</label><br>
        <input type="email" name="correo" value="<?php echo htmlspecialchars($c['correo']); ?>"><br><br>

        <label>Dirección:</label><br>
        <input type="text" name="direccion" value="<?php echo htmlspecialchars($c['direccion']); ?>"><br><br>

        <button type="submit">Actualizar Cliente</button>
    </form>

    <br>
    <a href="index.php?accion=listarClientes">Volver al listado</a>

</body>
</html>