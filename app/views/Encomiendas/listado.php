<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Encomiendas</title>
</head>
<body>
    <h2>Encomiendas Registradas</h2>
    <a href="?action=registro_encomienda">Nueva encomienda</a>
    <a href="?action=inicio">Inicio</a>
    <br><br>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Peso (kg)</th>
                <th>Destino</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($encomiendas as $enc): ?>
            <tr>
                <td><?= htmlspecialchars($enc['id']) ?></td>
                <td><?= htmlspecialchars($enc['cliente_nombre']) ?></td>
                <td><?= htmlspecialchars($enc['peso']) ?></td>
                <td><?= htmlspecialchars($enc['destino']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>