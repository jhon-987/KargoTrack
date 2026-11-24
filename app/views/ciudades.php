

<?php

require_once __DIR__ . '/../controllers/CiudadController.php';

$controller = new CiudadController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $departamento = trim($_POST['departamento']);

    $controller->registrar($nombre, $departamento);

    header('Location: ciudades.php');
    exit;
}

$ciudades = $controller->listar();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Ciudades - KargoTrack</title>

</head>

<body>

<div class="container">

    <h2>Gestión de Ciudades</h2>

    <div class="card">
        <h3>Registrar Ciudad</h3>

        <form method="POST">
            <div class="form-group">
                <label>Nombre de ciudad</label>
                <input type="text" name="nombre" placeholder="Ingrese el nombre de la ciudad" required>
            </div>

            <div class="form-group">
                <label>Departamento</label>
                <input type="text" name="departamento" placeholder="Ingrese el departamento" required>
            </div>

            <button type="submit">Registrar Ciudad</button>
        </form>
    </div>

    <div class="card">
        <h3>Listado de Ciudades</h3>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ciudad</th>
                    <th>Departamento</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($ciudades)): ?>
                    <?php foreach ($ciudades as $ciudad): ?>
                        <tr>
                            <td><?= htmlspecialchars($ciudad['id_ciudad']) ?></td>
                            <td><?= htmlspecialchars($ciudad['nombre']) ?></td>
                            <td><?= htmlspecialchars($ciudad['departamento']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="empty">No hay ciudades registradas</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
