<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Operativo - KargoTrack</title>
    <link rel="stylesheet" href="public/css/estilos_admin.css"> 
</head>
<body>

    <div class="dashboard-layout">
        <!-- Navegación Lateral -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <h2>KargoTrack</h2>
                <span>Operaciones</span>
            </div>
            <ul class="sidebar-menu">
                <li><a href="index.php?accion=dashboardOperador" class="active">Inicio / Resumen</a></li>
                <li><a href="index.php?accion=listarClientes">Gestión de Clientes</a></li>
                <li><a href="index.php?accion=listarEncomiendas">Registro de Encomiendas</a></li>
                <li><a href="index.php?accion=listarEnvios">Envíos y Rutas</a></li>
                <li><a href="index.php?accion=listarSeguimiento">Control de Tracking</a></li>
                <li><a href="index.php?accion=logout" class="logout-link">Cerrar Sesión</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="content-header">
                <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Operador', ENT_QUOTES, 'UTF-8'); ?></h2>
                <span class="badge-operador">Operador</span> 
            </header>

            <section class="cards-grid">
                <div class="card">
                    <h3>Gestión de Clientes</h3>
                    <p>Registra nuevos remitentes y destinatarios para asociarlos a los paquetes.</p>
                    <a href="index.php?accion=listarClientes" class="btn-card">Ver Directorio</a>
                </div>

                <div class="card">
                    <h3>Recepción de Encomiendas</h3>
                    <p>Ingresa nuevos paquetes, registra su peso y genera la orden.</p>
                    <a href="index.php?accion=registroEncomienda" class="btn-card">Gestionar Paquetes</a>
                </div>

                <div class="card">
                    <h3>Despacho y Envíos</h3>
                    <p>Asigna las encomiendas a los vehículos y choferes para su traslado.</p>
                    <a href="index.php?accion=listarEnvios" class="btn-card">Controlar Envíos</a>
                </div>

                <div class="card">
                    <h3>Actualización de Tracking</h3>
                    <p>Actualiza los estados (En Tránsito, Entregado) para el rastreo del cliente.</p>
                    <a href="index.php?accion=listarSeguimiento" class="btn-card">Actualizar Estados</a>
                </div>
            </section>
        </main>
    </div>

</body>
</html>