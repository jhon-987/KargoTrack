<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Clientes</title>
</head>
<body>
    <h2>Cliente Registardo</h2>
    <a href="/kargotrack/public/index.php?action=registro_cliente">Nuevo Cliente</a>

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
                <td>htmlspecialchars($cliente['id']) ?></td>
                <td>htmlspecialchars($cliente['nombre']) ?></td>
                <td>htmlspecialchars($cliente['Documento']) ?></td>
                <td>htmlspecialchars($cliente['telefono']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>