<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo 5 - KargoTrack</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f5f9;
            margin: 0;
            padding: 30px 15px;
        }

        .contenedor {
            max-width: 650px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 15px #00000015;
        }

        h1 {
            color: #173b68;
        }

        p {
            color: #666;
        }

        .opciones {
            display: grid;
            gap: 15px;
            margin-top: 25px;
        }

        a {
            display: block;
            padding: 15px;
            background: #1764aa;
            color: white;
            border-radius: 7px;
            text-decoration: none;
        }

        a:hover {
            background: #104b80;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h1>KargoTrack</h1>
        <p>Seguimiento de encomiendas y confirmación de entregas</p>

        <div class="opciones">
            <a href="seguimiento.php">Registrar seguimiento</a>
            <a href="historial_seguimiento.php">Consultar historial</a>
            <a href="entregas.php">Confirmar entrega</a>
            <a href="consultar_entrega.php">Consultar entrega</a>
        </div>
    </div>
</body>
</html>