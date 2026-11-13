<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - KargoTrack</title>
    <link rel="stylesheet" href="public/css/estilos_login.css">
</head>
<body class="login-body">

    <div class="login-container">
        <h2>KargoTrack</h2>
        <p>Iniciar sesión</p>

        <?php if (isset($error)): ?>
            <div class="alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="index.php?accion=iniciarSesion" method="POST">
            <div class="form-group">
                <label for="correo">Correo electrónico:</label>
                <input type="email" id="correo" name="correo" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn-primary">Ingresar</button>
        </form>

    </div>

</body>
</html>