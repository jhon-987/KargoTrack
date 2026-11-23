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
                <li><a href="index.php?accion=dashboardAdmin" class="active">Inicio / Resumen</a></li>
                <li><a href="index.php?accion=listarUsuarios">Gestión de Usuarios</a></li>
                <li><a href="index.php?accion=listarRoles">Gestión de Roles</a></li>
                <li><a href="index.php?accion=listarClientes">Directorio de Clientes</a></li>
                <li><a href="index.php?accion=listarCiudades">Gestión de Ciudades</a></li>
                <li><a href="index.php?accion=listarVehiculos">Flota de Vehículos</a></li>
                <li><a href="index.php?accion=listarChoferes">Registro de Choferes</a></li>
                <li><a href="index.php?accion=listarEncomiendas">Registro de Encomiendas</a></li>
                <li><a href="index.php?accion=listarEnvios">Envíos y Rutas</a></li>
                <li><a href="index.php?accion=listarSeguimiento">Control de Tracking</a></li>
                <li><a href="index.php?accion=registroEncomienda">Registrar Nueva Encomienda</a></li>
                <li><a href="index.php?accion=registroVehiculo">Registrar Nuevo Vehículo</a></li>
                <li><a href="index.php?accion=registroChofer">Registrar Nuevo Chofer</a></li>
                <li><a href="index.php?accion=registroCliente">Registrar Nuevo Cliente</a></li>
                <li><a href="index.php?accion=registroCiudad">Registrar Nueva Ciudad</li>
                <li><a href="index.php?accion=registroRol">Registrar Nuevo Rol</li>
                <li><a href="index.php?accion=registroUsuario">Registrar Nuevo Usuario</li>
                <li><a href="index.php?accion=registroEnvio">Registrar Nuevo Envío</li>
                <li><a href="index.php?accion=registroTracking">Registrar Nuevo Tracking</li>
                <li><a href="index.php?accion=registroRuta">Registrar Nueva Ruta</li>
                <li><a href="index.php?accion=logout" class="logout-link">Cerrar Sesión</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="content-header">
                <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Administrador', ENT_QUOTES, 'UTF-8'); ?></h2>
                <span class="badge-admin">Administrador</span>
            </header>

            <section class="cards-grid">
                <div class="card">
                    <h3>👥 Control de Personal</h3>
                    <p>Administra usuarios, registra nuevos operadores y asigna roles.</p>
                    <div class="card-actions">
                        <a href="index.php?accion=listarUsuarios" class="btn-card">Ver Usuarios</a>
                        <a href="index.php?accion=formularioUsuario" class="btn-card btn-secondary-card">Registrar Nuevo</a>
                    </div>
                </div>

                <div class="card">
                    <h3>Roles del Sistema</h3>
                    <p>Consulta los permisos y perfiles configurados en la plataforma.</p>
                    <a href="index.php?accion=listarRoles" class="btn-card">Ver Roles</a>
                </div>

                <div class="card">
                    <h3>Gestión de Ciudades</h3>
                    <p>Administra las ciudades y departamentos para las rutas de envío.</p>
                    <a href="index.php?accion=listarCiudades" class="btn-card">Ver Ciudades</a>
                </div>

                <div class="card">
                    <h3>Flota de Vehículos</h3>
                    <p>Controla los camiones disponibles y sus placas.</p>
                    <a href="index.php?accion=listarVehiculos" class="btn-card">Ver Vehículos</a>
                </div>

                <div class="card">
                    <h3>Registro de Choferes</h3>
                    <p>Administra el registro y licencias de los conductores.</p>
                    <a href="index.php?accion=listarChoferes" class="btn-card">Ver Choferes</a>
                </div>
                
                <div class="card">
                    <h3>Directorio de Clientes</h3>
                    <p>Visualiza el registro de clientes externos de la empresa.</p>
                    <div class="card-actions">
                        <a href="index.php?accion=listarClientes" class="btn-card">Ver Clientes</a>
                        <a href="index.php?accion=registroCliente" class="btn-card btn-secondary-card">Registrar Nuevo</a>
                    </div>
                </div>

                <div class="card">
                    <h3>Registro de Encomiendas</h3>
                    <p>Registra los paquetes de los clientes con su peso y destino.</p>
                    <div class="card-actions">
                        <a href="index.php?accion=listarEncomiendas" class="btn-card">Ver Encomiendas</a>
                        <a href="index.php?accion=registroEncomienda" class="btn-card btn-secondary-card">Registrar Nueva</a>
                    </div>
                </div>
            </section>
        </main>
    </div>

</body>
</html>