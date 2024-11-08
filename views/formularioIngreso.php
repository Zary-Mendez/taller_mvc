<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Ingreso</title>
</head>

    <body>
        <form id="formularioIngreso" name="formIngreso" action="index.php?c=registros&a=ControllerGuardar" method="POST">

            <label>Ingrese codigo:</label>
            <input id="codigo" name="codigo" type="number" placeholder="Ingrese el codigo del estudiante" required>

            <br>
            <label>Ingrese nombre:</label>
            <input id="nombre" name="nombre" type="text" placeholder="Ingrese el nombre del estudiante" required>

            <br>
            <label>Ingrese programa:</label>
            <input id="programa" name="programa" type="text" placeholder="Ingrese el programa" required>

            <br>
            <label>Ingrese fecha:</label>
            <input id="fecha" name="fecha" type="date" placeholder="Ingrese la fecha de ingreso" required>

            <br>
            <label>Ingrese hora:</label>
            <input id="hora" name="hora" type="time" placeholder="Ingrese la hora de ingreso" required>

            <br>
            <label>Ingrese sala:</label>
            <input id="sala" name="sala" type="text" placeholder="Ingrese la sala a ingresar" required>

            <br>
            <label>Ingrese nombre responsable:</label>
            <input id="responsable" name="responsable" type="text" placeholder="Ingrese el nombre del responsable" required>

            <br>
            <button type="submit">Registrar</button>
        </form>

    </body>

</html>