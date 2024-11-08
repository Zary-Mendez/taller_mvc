<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresos y salidas</title>
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
                echo '</tr>';
            }

            ?>
        </tbody>
    </table>
    <button><a href="index.php?c=registros&a=index">Volver</a></button>
</body>

</html>