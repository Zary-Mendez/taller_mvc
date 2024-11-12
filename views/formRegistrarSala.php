<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Ingreso</title>
</head>

<body>
    <form id="formRegistroSalas" name="formRegistroSalas" action="index.php?c=registros&a=ControllerGuardarRegistroSalas" method="POST">

        <label for="dia">Seleccione un día:</label>
        <select id="dia" name="dia">
            <option value="Lunes">Lunes</option>
            <option value="Martes">Martes</option>
            <option value="Miercoles">Miércoles</option>
            <option value="Jueves">Jueves</option>
            <option value="Viernes">Viernes</option>
            <option value="Sábado">Sábado</option>
        </select>

        <br>
        <br>

        <label>Ingrese materia:</label>
        <input id="materiaCurso" name="materiaCurso" type="text" placeholder="Ingrese materia" required>

        <br>
        <br>

        <label>Ingrese hora de inicio:</label>
        <input id="horaInicioCurso" name="horaInicioCurso" type="time" placeholder="Ingrese hora de inicio" required>

        <br>
        <br>

        <label>Ingrese hora de salida:</label>
        <input id="horaFinCurso" name="horaFinCurso" type="time" placeholder="Ingrese hora de salida" required>

        <br>
        <br>

        <label>Ingrese programa:</label>
        <input id="programaCurso" name="programaCurso" type="text" placeholder="Ingrese programa" required>

        <br>
        <br>

        <label>Ingrese sala:</label>
        <input id="salaCurso" name="salaCurso" type="text" placeholder="Ingrese sala a apartar" required>

        <br>
        <br>
        <button type="submit">Registrar</button>
    </form>


</body>

<link rel="stylesheet" href="public/estilos.css">

</html>