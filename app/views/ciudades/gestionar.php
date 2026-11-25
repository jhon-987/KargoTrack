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

        .alerta-ok, .alerta-error {
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .alerta-ok {
            background: #dcfce7;
            color: #166534;
        }

        .alerta-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .volver {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Gestión de Ciudades</h2>

    <?php if (!empty($mensaje)): ?>
        <p class="alerta-error"><?= htmlspecialchars($mensaje) ?></p>
    <?php elseif (!empty($exito)): ?>
        <p class="alerta-ok">Ciudad registrada correctamente.</p>
    <?php endif; ?>

    <div class="card">
        <h3>Registrar Ciudad</h3>

        <form method="POST" action="index.php?accion=registroCiudad">
            <div class="form-group">
                <label>Nombre de ciudad</label>
                <input type="text" name="nombre" value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>" placeholder="Ingrese el nombre de la ciudad" required>
            </div>

            <div class="form-group">
                <label>Departamento</label>
                <input type="text" name="departamento" value="<?= htmlspecialchars($_POST['departamento'] ?? '') ?>" placeholder="Ingrese el departamento" required>
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

    <p class="volver"><a href="index.php?accion=<?php echo ($_SESSION["idRol"] ?? 1) == 1 ? "dashboardAdmin" : "dashboardOperador"; ?>">Volver al panel</a></p>

</div>

</body>
</html>
