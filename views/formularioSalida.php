<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salida</title>
</head>

<body>
    <form name="formularioSalida" id="formularioSalida" action="index.php?c=registros&a=ControllerValidarCodigoSalida" method="POST">
        <label>Ingrese codigo del estudiante registrado</label>
        <input type="number" name="codigoSalida" id="codigoSalida" placeholder="Ingrese codigo del estudiante">

        <label>Ingrese la hora de salida</label>
        <input type="time" name="horaSalida" id="horaSalida" placeholder="Ingrese la hora de salida">

        <button type="submit">Registrar Salida</button>
    </form>
</body>

</html>