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
        <aside class="sidebar">
            <div class="sidebar-brand">
                <h2>KargoTrack</h2>
                <span>Administración</span>
            </div>
            <ul class="sidebar-menu">
                <li><a href="index.php?accion=dashboardAdmin" class="active">Resumen</a></li>
                <li class="menu-titulo">Operación</li>
                <li><a href="index.php?accion=listarEncomiendas">Encomiendas</a></li>
                <li><a href="index.php?accion=listarEnvios">Envíos</a></li>
                <li><a href="index.php?accion=listarSeguimiento">Seguimiento y entregas</a></li>
                <li class="menu-titulo">Flota</li>
                <li><a href="index.php?accion=listarVehiculos">Vehículos</a></li>
                <li><a href="index.php?accion=listarChoferes">Choferes</a></li>
                <li class="menu-titulo">Administración</li>
                <li><a href="index.php?accion=listarClientes">Clientes</a></li>
                <li><a href="index.php?accion=listarCiudades">Ciudades</a></li>
                <li><a href="index.php?accion=listarUsuarios">Usuarios</a></li>
                <li><a href="index.php?accion=listarRoles">Roles</a></li>
            </ul>
            <div class="sidebar-usuario">
                <strong><?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Administrador', ENT_QUOTES, 'UTF-8'); ?></strong>
                <a href="index.php?accion=logout" class="logout-link">Cerrar sesión</a>
            </div>
        </aside>

        <main class="main-content">
            <header class="content-header">
                <div>
                    <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Administrador', ENT_QUOTES, 'UTF-8'); ?></h2>
                    <p class="subtitulo">Así va la operación de la empresa.</p>
                </div>
                <span class="badge-admin">Administrador</span>
            </header>

            <section class="resumen">
                <h3>Resumen</h3>
                <?php if ($resumen) { ?>
                <div class="resumen-grid">
                    <a href="index.php?accion=listarEnvios" class="resumen-card">
                        <span class="resumen-numero"><?php echo (int) $resumen['pendientes']; ?></span>
                        <span class="resumen-texto">Encomiendas esperando envío</span>
                        <span class="resumen-link">Programar envío →</span>
                    </a>
                    <a href="index.php?accion=listarSeguimiento" class="resumen-card">
                        <span class="resumen-numero"><?php echo (int) $resumen['en_curso']; ?></span>
                        <span class="resumen-texto">Envíos en camino</span>
                        <span class="resumen-link">Actualizar seguimiento →</span>
                    </a>
                    <a href="index.php?accion=listarEncomiendas" class="resumen-card">
                        <span class="resumen-numero"><?php echo (int) $resumen['entregadas']; ?></span>
                        <span class="resumen-texto">Encomiendas entregadas</span>
                        <span class="resumen-link">Ver encomiendas →</span>
                    </a>
                    <a href="index.php?accion=vehiculosDisponibles" class="resumen-card">
                        <span class="resumen-numero"><?php echo (int) $resumen['vehiculos_libres']; ?></span>
                        <span class="resumen-texto">Vehículos disponibles</span>
                        <span class="resumen-link">Ver flota →</span>
                    </a>
                    <a href="index.php?accion=listarClientes" class="resumen-card">
                        <span class="resumen-numero"><?php echo (int) $resumen['clientes']; ?></span>
                        <span class="resumen-texto">Clientes registrados</span>
                        <span class="resumen-link">Ver clientes →</span>
                    </a>
                </div>
                <?php } else { ?>
                <p class="resumen-error">No se pudo cargar el resumen, intente de nuevo.</p>
                <?php } ?>
            </section>

            <?php require __DIR__ . '/pendientes.php'; ?>
        </main>
    </div>

</body>
</html>