<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salas</title>
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <th>Nombres de las salas</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php

                foreach ($data['salas'] as $dato) {
                    echo '<tr>';
                    echo '<td>' . $dato['nombre'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tr>
        </tbody>
    </table>
    <button><a href="index.php?c=registros&a=index">Volver</a></button>
</body>

</html>
