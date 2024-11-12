<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion de ingresos y salidas</title>
</head>

<body>
    <H1>Registro Ingresos</H1>

    <table border="1">
        <thead>
            <tr>
                <th>Codigo Estudiante</th>
                <th>Nombre Estudiante</th>
                <th>Id Programa</th>
                <th>Fecha Ingreso</th>
                <th>Hora Ingreso</th>
                <th>hora Salida</th>
                <th>Id Responsable</th>
                <th>Id Sala</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data['registros'] as $dato) {
                echo '<tr>';
                echo '<td>' . $dato['codigoEstudiante'] . '</td>';
                echo '<td>' . $dato['nombreEstudiante'] . '</td>';
                echo '<td>' . $dato['idPrograma'] . '</td>';
                echo '<td>' . $dato['fechaIngreso'] . '</td>';
                echo '<td>' . $dato['horaIngreso'] . '</td>';
                echo '<td>' . $dato['horaSalida'] . '</td>';
                echo '<td>' . $dato['idResponsable'] . '</td>';
                echo '<td>' . $dato['idSala'] . '</td>';
                echo '<td><a href="index.php?c=registros&a=ControllerModificarRegistro&codigo=' . $dato['codigoEstudiante'] . '&nombre=' . $dato['nombreEstudiante'] . '">Modificar</a></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <button><a href="index.php?c=registros&a=index">Volver</a></button>
</body>

<link rel="stylesheet" href="public/estilos.css">

</html>