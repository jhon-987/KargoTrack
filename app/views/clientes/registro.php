<!DOCTYPE html>
<html lang="es">
    <head>
        <meta> charset="UTF-8">
        <title>Registrar Cliente</title>
    </head>
    <body>
        <h2>Registrar nuevo Cliente</h2>

        <form action="/kargotrack/public/index.php?action=guardar_cliente" method="POST"
        
        <div>
            <label for="nombre">Nombre completo:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <div>
            <label for="documento">Documento (DNI/RUC):</label>
            <input type="text" id="documento" name="documento" required>
        </div>

         <div>
            <label for="telefono"> Telefono:</label>
            <input type="text" id="telefono" name="telefono" required>
        </div>
        <button>type="submit">Guardar Cliente</button>
      </form>
    </body>
</html>