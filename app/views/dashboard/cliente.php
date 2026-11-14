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
        <nav>
            <a href="index.php?accion=inicio">Volver al Inicio</a>
        </nav>
    </header>

    <main class="client-main">
        <div class="tracking-box">
            <h2>Consulta el Estado de tu Envío</h2>
            <p>Ingresa tu código único de seguimiento para verificar el estado actual de tu encomienda.</p>
            
            <form action="index.php" method="GET" class="tracking-inline-form">
                <input type="hidden" name="accion" value="consultarTracking">
                <input type="text" name="codigo" placeholder="Ej. TRK-123456" value="<?php echo htmlspecialchars($codigoBuscado ?? ''); ?>" required>
                <button type="submit">Buscar</button>
            </form>
        </div>

        <!-- resultado de busqueda -->
        <?php if (isset($envio) && $envio): ?>
            <div class="tracking-result-card">
                <h3>Información del Envío</h3>
                
                <div class="status-badge">
                    Estado Actual: <strong><?php echo htmlspecialchars($envio['estado']); ?></strong>
                </div>

                <ul class="details-list">
                    <li><strong>Código de Seguimiento:</strong> <?php echo htmlspecialchars($envio['codigo']); ?></li>
                    <li><strong>Origen:</strong> <?php echo htmlspecialchars($envio['origen']); ?></li>
                    <li><strong>Destino:</strong> <?php echo htmlspecialchars($envio['destino']); ?></li>
                    <li><strong>Destinatario:</strong> <?php echo htmlspecialchars($envio['destinatario']); ?></li>
                    <li><strong>Fecha de Registro:</strong> <?php echo htmlspecialchars($envio['fecha_registro']); ?></li>
                </ul>

                <!-- Seguimiento -->
                <div class="timeline">
                    <div class="timeline-step completed">1. Registrado</div>
                    <div class="timeline-step <?php echo ($envio['estado'] != 'Registrado') ? 'completed' : ''; ?>">2. En Tránsito</div>
                    <div class="timeline-step <?php echo ($envio['estado'] == 'Entregado') ? 'completed' : ''; ?>">3. Entregado</div>
                </div>
            </div>

        <?php elseif (isset($errorBusqueda)): ?>
            <div class="tracking-error-card">
                <p><?php echo htmlspecialchars($errorBusqueda); ?></p>
            </div>
        <?php endif; ?>

    </main>

</body>
</html>