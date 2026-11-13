<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Cliente - KargoTrack</title>
    <link rel="stylesheet" href="public/css/estilos_cliente.css">
</head>
<body>

    <header class="client-header">
        <div class="logo">KargoTrack</div>
        <div class="user-info">
            <span>Hola, <?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Cliente', ENT_QUOTES, 'UTF-8'); ?></span>
            <a href="index.php?accion=logout" class="btn-logout">Cerrar Sesión</a>
        </div>
    </header>

    <main class="client-main">
        <div class="tracking-box">
            <h2>Consulta el Estado de tu Envío</h2>
            <p>Ingresa tu código único de seguimiento para verificar el estado actual de tu encomienda.</p>
            <form action="index.php?accion=consultarTracking" method="GET" class="tracking-inline-form">
                <input type="hidden" name="accion" value="consultarTracking">
                <input type="text" name="codigo" placeholder="Ej. TRK-123456" required>
                <button type="submit">Buscar</button>
            </form>
        </div>
    </main>

</body>
</html>