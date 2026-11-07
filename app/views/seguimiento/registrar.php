
<?php
$mensaje = $mensaje ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento de Encomiendas - KargoTrack</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f5f9;
            margin: 0;
            padding: 30px 15px;
        }

        .contenedor {
            max-width: 550px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px #00000015;
        }

        h2 {
            color: #173b68;
            text-align: center;
        }

        p {
            color: #666;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, select, button {
            width: 100%;
            padding: 12px;
            margin-top: 7px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 15px;
        }

        button {
            margin-top: 25px;
            background: #1764aa;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #104b80;
        }

        .mensaje {
            background: #e9f4ff;
            padding: 12px;
            border-radius: 7px;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="contenedor">
    <h2>KargoTrack</h2>
    <p>Registro de seguimiento de encomiendas</p>

    <?php if ($mensaje !== ''): ?>
        <div class="mensaje">
            <?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="id_encomienda">ID de encomienda</label>
        <input
            type="number"
            id="id_encomienda"
            name="id_encomienda"
            min="1"
            required
            placeholder="Ejemplo: 1"
        >

        <label for="ubicacion">Ubicación actual</label>
        <input
            type="text"
            id="ubicacion"
            name="ubicacion"
            maxlength="150"
            required
            placeholder="Ejemplo: Huánuco"
        >

        <label for="estado">Estado de la encomienda</label>
        <select id="estado" name="estado" required>
            <option value="">Seleccione un estado</option>
            <option value="Registrado">Registrado</option>
            <option value="En tránsito">En tránsito</option>
            <option value="Recibido en destino">
                Recibido en destino
            </option>
            <option value="Entregado">Entregado</option>
        </select>

        <button type="submit">
            Registrar seguimiento
        </button>
    </form>
</div>

</body>
</html>

