<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica</title>
</head>

<body>
    <form action="index.php?c=registros&a=ControllerModificar" method="POST">

        <input type="hidden" id="codigoViejo" name="codigoViejo" value="<?php echo $codigo; ?>">

        <label>Codigo:</label>
        <input type="number" id="codigoNuevo" name="codigoNuevo" value="<?php echo $codigo; ?>">

        <br><br>

        <label>Nombre:</label>
        <input type="text" id="nombreNuevo" name="nombreNuevo" value="<?php echo $_GET['nombre']; ?>">

        <button type="submit">Guardar</button>
    </form>
</body>

<link rel="stylesheet" href="public/estilos.css">

</html>