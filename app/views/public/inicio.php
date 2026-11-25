<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KargoTrack - Especialistas en Transporte y Encomiendas</title>
    <link rel="stylesheet" href="public/css/estilos_inicio.css">
</head>
<body>

    <header class="public-header">
        <div class="logo">
            <span class="logo-text">📦 KargoTrack</span>
        </div>
        <nav class="public-nav">
            <a href="index.php?accion=inicio" class="nav-link active">Inicio</a>
            <a href="#servicios" class="nav-link">Servicios</a>
            <a href="#cobertura" class="nav-link">Cobertura</a>
            <a href="index.php?accion=iniciarSesion" class="btn-intranet">Acceso Personal</a>
        </nav>
    </header>

    <main class="public-main">
        <section class="hero-section">
            <div class="hero-content">
                <h1>Rastrea tu Encomienda al Instante</h1>
                <p>Ingresa el número de encomienda que figura en tu comprobante para conocer la ubicación y el estado actual de tu envío en tiempo real.</p>

                <form action="index.php" method="GET" class="tracking-form">
                    <input type="hidden" name="accion" value="consultarTracking">
                    <div class="input-group">
                        <input type="number" name="id_encomienda" min="1" placeholder="Ej. 15" required autocomplete="off">
                        <button type="submit" class="btn-buscar">Consultar Estado</button>
                    </div>
                </form>
            </div>
        </section>

        <section id="servicios" class="services-section">
            <div class="section-title">
                <h2>¿Por qué elegir KargoTrack?</h2>
                <p>Garantizamos rapidez, seguridad y transparencia en cada envío.</p>
            </div>
            
            <div class="services-grid">
                <div class="service-card">
                    <div class="icon">🚚</div>
                    <h3>Flota Moderna</h3>
                    <p>Contamos con vehículos de carga pesada y ligera en óptimas condiciones para asegurar que tu encomienda viaje segura.</p>
                </div>
                <div class="service-card">
                    <div class="icon">⏱️</div>
                    <h3>Entregas Puntuales</h3>
                    <p>Planificamos nuestras rutas estratégicamente entre ciudades para cumplir con los tiempos de llegada establecidos.</p>
                </div>
                <div class="service-card">
                    <div class="icon">📍</div>
                    <h3>Tracking 24/7</h3>
                    <p>Nuestro sistema te permite monitorear desde que el paquete sale de origen hasta que es recibido por el destinatario.</p>
                </div>
            </div>
        </section>

        <section id="cobertura" class="coverage-section">
            <div class="coverage-content">
                <h2>Conectamos Ciudades</h2>
                <p>Transportamos tus paquetes a través de las principales rutas del país. Nuestros operadores registran cada punto de control para que nunca pierdas de vista tu encomienda.</p>
                <?php if (!empty($ciudades)) { ?>
                <ul class="ciudades-lista">
                    <?php foreach ($ciudades as $ciudad) { ?>
                    <li><?php echo htmlspecialchars($ciudad['nombre']); ?> <span><?php echo htmlspecialchars($ciudad['departamento']); ?></span></li>
                    <?php } ?>
                </ul>
                <?php } ?>
            </div>
        </section>
    </main>

    <footer class="public-footer">
        <div class="footer-content">
            <div class="footer-info">
                <h3>KargoTrack S.A.</h3>
                <p>Sistema Integrado de Gestión Logística.</p>
            </div>
            <div class="footer-contact">
                <p>Atención al cliente: soporte@kargotrack.com</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> KargoTrack - Empresa de Transporte. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>