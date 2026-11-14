
<?php

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KargoTrack - Sistema de Gestión</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #f5f6fa;
            color: #333;
        }

        header {
            background: #1e293b;
            color: white;
            padding: 22px 40px;
        }

        header h1 {
            margin: 0;
        }

        header p {
            margin-bottom: 0;
            color: #cbd5e1;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
        }

        .container h2 {
            color: #1e293b;
            margin-bottom: 25px;
        }

        .menu {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }

        .card h3 {
            color: #1e40af;
            margin-top: 0;
        }

        .card p {
            color: #64748b;
            line-height: 1.5;
        }

        .card a {
            display: inline-block;
            margin-top: 15px;
            padding: 11px 20px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .card a:hover {
            background: #1d4ed8;
        }

        @media (max-width: 650px) {
            .menu {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<header>
    <h1>KargoTrack</h1>
    <p>Sistema de gestión de encomiendas y transporte</p>
</header>

<div class="container">

    <h2>Panel de Gestión</h2>

    <div class="menu">

        <div class="card">
            <h3>Gestión de Ciudades</h3>
            <p>Registro y consulta de ciudades y departamentos.</p>
            <a href="app/views/ciudades.php">Ingresar</a>
        </div>

        <div class="card">
            <h3>Gestión de Envíos</h3>
            <p>Programación y consulta de envíos y transporte.</p>
            <a href="app/views/envios.php">Ingresar</a>
        </div>

    </div>

</div>

</body>
</html>
