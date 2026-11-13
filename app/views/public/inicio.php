<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KargoTrack - Sistema de Gestión y Seguimiento de Encomiendas</title>
    <link rel="stylesheet" href="public/css/estilos_inicio.css">
</head>
<body>

    <header class="public-header">
        <div class="logo">KargoTrack</div>
        <nav>
            <a href="index.php?accion=inicio" class="nav-link">Inicio</a>
            <a href="index.php?accion=login" class="btn-intranet">Acceso Personal</a>
        </nav>
    </header>

    <main class="hero-section">
        <div class="hero-content">
            <h1>Rastrea tu Encomienda al Instante</h1>
            <p>Ingresa el código único de seguimiento proporcionado en tu comprobante para conocer el estado actual de tu envío[cite: 3].</p>

            <form action="index.php?accion=consultarTracking" method="GET" class="tracking-form">
                <input type="hidden" name="accion" value="consultarTracking">
                <input type="text" name="codigo" placeholder="Ej. TRK-987654" required>
                <button type="submit" class="btn-buscar">Consultar</button>
            </form>
        </div>
    </main>

    <footer class="public-footer">
        <p>&copy; 2026 KargoTrack - Empresa de Transporte. Todos los derechos reservados.</p>
    </footer>

</body>
</html>