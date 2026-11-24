<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Envíos - KargoTrack</title>

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
            max-width: 1100px;
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

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .form-group {
            margin-bottom: 5px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        button {
            margin-top: 20px;
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
            padding: 13px;
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

        @media (max-width: 700px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .card {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Gestión de Envíos</h2>

    <div class="card">
        <h3>Programar Envío</h3>

        <form method="POST" action="index.php?accion=registroEnvio">
            <div class="form-grid">

                <div class="form-group">
                    <label>ID de Encomienda</label>
                    <input type="number" name="id_encomienda" required>
                </div>

                <div class="form-group">
                    <label>Ciudad de Origen</label>
                    <select name="id_ciudad_origen" required>
                        <option value="">Seleccione ciudad</option>
                        <?php foreach ($ciudades as $ciudad): ?>
                            <option value="<?= htmlspecialchars($ciudad['id_ciudad']) ?>">
                                <?= htmlspecialchars($ciudad['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Ciudad de Destino</label>
                    <select name="id_ciudad_destino" required>
                        <option value="">Seleccione ciudad</option>
                        <?php foreach ($ciudades as $ciudad): ?>
                            <option value="<?= htmlspecialchars($ciudad['id_ciudad']) ?>">
                                <?= htmlspecialchars($ciudad['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>ID de Vehículo</label>
                    <input type="number" name="id_vehiculo" required>
                </div>

                <div class="form-group">
                    <label>ID de Chofer</label>
                    <input type="number" name="id_chofer" required>
                </div>

                <div class="form-group">
                    <label>Fecha de Salida</label>
                    <input type="date" name="fecha_salida" required>
                </div>

                <div class="form-group">
                    <label>Fecha de Llegada</label>
                    <input type="date" name="fecha_llegada" required>
                </div>

            </div>

            <button type="submit">Programar Envío</button>
        </form>
    </div>

    <div class="card">
        <h3>Listado de Envíos</h3>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Encomienda</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Vehículo</th>
                    <th>Chofer</th>
                    <th>Salida</th>
                    <th>Llegada</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($envios)): ?>
                    <?php foreach ($envios as $envio): ?>
                        <tr>
                            <td><?= htmlspecialchars($envio['id_envio']) ?></td>
                            <td><?= htmlspecialchars($envio['id_encomienda']) ?></td>
                            <td><?= htmlspecialchars($envio['id_ciudad_origen']) ?></td>
                            <td><?= htmlspecialchars($envio['id_ciudad_destino']) ?></td>
                            <td><?= htmlspecialchars($envio['id_vehiculo']) ?></td>
                            <td><?= htmlspecialchars($envio['id_chofer']) ?></td>
                            <td><?= htmlspecialchars($envio['fecha_salida']) ?></td>
                            <td><?= htmlspecialchars($envio['fecha_llegada']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="empty">No hay envíos registrados</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
