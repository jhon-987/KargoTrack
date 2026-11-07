<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - KargoTrack</title>
</head>
<body>

    <h1>KargoTrack</h1>
    <h2>Iniciar sesión</h2>

    <form action="index.php?accion=iniciarSesion" method="POST">

        <label for="correo">Correo electrónico:</label>
        <input
            type="email"
            id="correo"
            name="correo"
            required
        >

        <br><br>

        <label for="password">Contraseña:</label>
        <input
            type="password"
            id="password"
            name="password"
            required
        >

        <br><br>

        <button type="submit">Ingresar</button>

    </form>

</body>
</html>
