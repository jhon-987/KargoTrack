

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

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            padding: 30px;
            background: #f5f6fa;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        h2 {
            color: #243b53;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        button {
            background: #2563eb;
            color: white;
            border: none;
            padding: 12px 22px;
            border-radius: 6px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f1f5f9;
            color: #334155;
        }

        .empty {
            text-align: center;
            color: #888;
        }
    </style>
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
