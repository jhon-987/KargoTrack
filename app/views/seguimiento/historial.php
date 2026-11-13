
<?php
$historial = $historial ?? [];
$idEncomienda = $idEncomienda ?? 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de seguimiento - KargoTrack</title>
    <style>
        * { box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            background: #f3f5f9;
            margin: 0;
            padding: 30px 15px;
        }

        .contenedor {
            max-width: 950px;
            margin: 25px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px #00000015;
        }

        h2 {
            color: #173b68;
            text-align: center;
        }

        p { color: #666; text-align: center; }

        form {
            display: flex;
            gap: 10px;
            margin: 25px 0;
        }

        input, button {
            padding: 12px;
            border-radius: 7px;
            font-size: 15px;
        }

        input {
            flex: 1;
            min-width: 0;
            border: 1px solid #ccc;
        }

        button {
            background: #1764aa;
            color: white;
            border: none;
            cursor: pointer;
        }

        .tabla {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #173b68;
            color: white;
        }

        tr:hover { background: #f5f8fc; }

        .vacio {
            padding: 20px;
            text-align: center;
            color: #777;
        }

        a {
            color: #1764aa;
            text-decoration: none;
        }

        @media (max-width: 600px) {
            form { flex-direction: column; }
        }
    </style>
</head>
<body>

<div class="contenedor">
    <h2>KargoTrack</h2>
    <p>Historial de seguimiento de encomiendas</p>

    <form method="GET" action="">
        <input
            type="number"
            name="id_encomienda"
            min="1"
            required
            placeholder="Ingrese el ID de encomienda"
            value="<?= $idEncomienda > 0 ? (int)$idEncomienda : '' ?>"
        >
        <button type="submit">Buscar historial</button>
    </form>

    <div class="tabla">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Encomienda</th>
                    <th>Fecha</th>
                    <th>Ubicación</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($historial)): ?>
                    <tr>
                        <td colspan="5" class="vacio">
                            No hay movimientos para mostrar.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($historial as $registro): ?>
                        <tr>
                            <td><?= (int)$registro['id_seguimiento'] ?></td>
                            <td><?= (int)$registro['id_encomienda'] ?></td>
                            <td><?= htmlspecialchars($registro['fecha'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($registro['ubicacion'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($registro['estado'], ENT_QUOTES, 'UTF-8') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <p>
    <a href="seguimiento.php">Registrar nuevo seguimiento</a>
</p>

<p>
    <a href="modulo5.php">Volver al menú del módulo 5</a>
</p>
</div>

</body>
</html>

