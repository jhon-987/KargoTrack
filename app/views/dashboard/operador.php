<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Operativo - KargoTrack</title>
    <link rel="stylesheet" href="public/css/estilos_operador.css">
</head>
<body>

    <div class="dashboard-layout">
        <!-- Sidebar de Navegación del Operador -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <h2>KargoTrack</h2>
                <span>Portal Operativo</span>
            </div>
            <ul class="sidebar-menu">
                <li><a href="index.php?accion=dashboardOperador" class="active">Panel Principal</a></li>
                <li><a href="index.php?accion=listarClientes">Gestión de Clientes</a></li>
                <li><a href="index.php?accion=formularioCliente">Registrar Cliente</a></li>
                <li><a href="index.php?accion=logout" class="logout-link">Cerrar Sesión</a></li>
            </ul>
        </aside>

        <!-- Contenido Principal -->
        <main class="main-content">
            <header class="content-header">
                <h2>Hola, <?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Operador', ENT_QUOTES, 'UTF-8'); ?></h2>
                <span class="badge-operador">Personal Operativo</span>
            </header>

            <section class="cards-grid">
                <div class="card">
                    <h3>Directorio de Clientes</h3>
                    <p>Consulta los datos de los clientes o registra nuevos usuarios para asociarlos a los envíos.</p>
                    <a href="index.php?accion=listarClientes" class="btn-card">Ver Clientes</a>
                </div>
                
                <div class="card">
                    <h3>Gestión de Encomiendas</h3>
                    <p>Registra nuevos paquetes, asigna detalles y actualiza estados durante el traslado[cite: 2].</p>
                    <span class="info-tag">Módulo Operativo Activo</span>
                </div>
            </section>
        </main>
    </div>

</body>
</html>