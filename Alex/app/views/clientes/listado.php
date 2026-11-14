<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Clientes</title>
</head>
<body>
    <h2>Clientes registrados</h2>
    <a href="?action=registro_cliente">Nuevo cliente</a>
    <a href="?action=inicio">Inicio</a>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Documento</th>
                <th>Telefono</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?= htmlspecialchars($cliente['id'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($cliente['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($cliente['documento'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($cliente['telefono'], ENT_QUOTES, 'UTF-8') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>