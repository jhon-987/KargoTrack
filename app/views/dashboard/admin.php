<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador - KargoTrack</title>
    <link rel="stylesheet" href="public/css/estilos_admin.css">
</head>
<body>

    <div class="dashboard-layout">
        <!-- Sidebar de Navegación -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <h2>KargoTrack</h2>
                <span>Administración</span>
            </div>
            <ul class="sidebar-menu">
                <li><a href="index.php?accion=dashboardAdmin" class="active">Inicio / Resumen</a></li>
                <li><a href="index.php?accion=listarUsuarios">Gestión de Usuarios</a></li>
                <li><a href="index.php?accion=formularioUsuario">Registrar Usuario</a></li>
                <li><a href="index.php?accion=listarRoles">Gestión de Roles</a></li>
                <li><a href="index.php?accion=listarClientes">Listar Clientes</a></li>
                <li><a href="index.php?accion=logout" class="logout-link">Cerrar Sesión</a></li>
            </ul>
        </aside>

        <!-- Contenido Principal -->
        <main class="main-content">
            <header class="content-header">
                <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Administrador', ENT_QUOTES, 'UTF-8'); ?></h2>
                <span class="badge-admin">Administrador</span>
            </header>

            <section class="cards-grid">
                <div class="card">
                    <h3>Control de Personal</h3>
                    <p>Administra los usuarios internos, registra nuevos operadores o administradores y asigna roles del sistema[cite: 1].</p>
                    <div class="card-actions">
                        <a href="index.php?accion=listarUsuarios" class="btn-card">Ver Usuarios</a>
                        <a href="index.php?accion=formularioUsuario" class="btn-card btn-secondary-card">Registrar Nuevo</a>
                    </div>
                </div>

                <div class="card">
                    <h3>Roles del Sistema</h3>
                    <p>Consulta los permisos y perfiles configurados en la plataforma[cite: 1].</p>
                    <a href="index.php?accion=listarRoles" class="btn-card">Ver Roles</a>
                </div>

                <div class="card">
                    <h3>Directorio de Clientes</h3>
                    <p>Visualiza el registro de clientes externos de la empresa para asociarlos a los envíos[cite: 2].</p>
                    <a href="index.php?accion=listarClientes" class="btn-card">Ver Clientes</a>
                </div>
            </section>
        </main>
    </div>

</body>
</html>