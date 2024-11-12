<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salida</title>
</head>

<body>
    <form name="formSalida" id="formSalida" action="index.php?c=registros&a=ControllerValidarCodigoSalida" method="POST">
        <label>Ingrese codigo del estudiante registrado</label>
        <input type="number" name="codigoSalida" id="codigoSalida" placeholder="Ingrese codigo del estudiante">

        <br>
        <br>

        <label>Ingrese hora de salida</label>
        <input type="time" name="horaSalida" id="horaSalida" placeholder="Ingrese hora de salida">

        <br>
        <br>

        <button type="submit">Registrar Salida</button>
    </form>
</body>

<link rel="stylesheet" href="public/estilos.css">

</html>