<?php
require_once 'conexion.php';            // conexión a base de datos escolar
require_once 'conexion3.php';   // conexión a base de datos encuesta
session_start();

$matricula = $_SESSION['matricula'];

// ✅ Consulta para obtener profesores del alumno
$sql = "SELECT DISTINCT idProfesor, nombreProfesor 
FROM valumno_materia 
WHERE matricula = ?";

$params = array($matricula);
$stmt = sqlsrv_query($conexion, $sql, $params);

if ($stmt === false) {
    die("❌ Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true));
}

// ✅ Guardamos los profesores en un arreglo
$profesores = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $profesores[] = [
    'id' => $row['idProfesor'],   // ✅ ahora es entero
    'nombre_completo' => $row['nombreProfesor']
];

}

// ✅ Consultamos preguntas desde la base de datos encuesta
$sqlPreguntas = "SELECT cvidPregunta, pregunta FROM CvPregunta WHERE activo = 1 ORDER BY prioridad";
$stmtPreguntas = sqlsrv_query($conexion_encuesta, $sqlPreguntas);

if ($stmtPreguntas === false) {
    die("❌ Error al cargar preguntas: " . print_r(sqlsrv_errors(), true));
}

$preguntas_bd = [];
while ($row = sqlsrv_fetch_array($stmtPreguntas, SQLSRV_FETCH_ASSOC)) {
    $preguntas_bd[] = [
        'id' => $row['cvidPregunta'],
        'texto' => $row['pregunta']
    ];
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Evaluación</title>
    <link rel="stylesheet" href="css/estilos-f.css">
    <style>
        .opciones {
            margin-left: 20px;
        }

        .opcion {
            margin-bottom: 8px;
        }

        ul, li {
            list-style: none;
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body class="form-body">

<div class="form-container">
    <div class="form-header">
        <img src="imagenes/logoUTZMG.png" alt="Logo UTZMG" class="logo-form">
        <h1>Formulario de Evaluación Docente UTZMG</h1>
    </div>

    <form action="guardar_respuestas.php" method="post" class="evaluation-form">

        <select id="profesor" name="profesor" required>
            <option value="" disabled selected>Seleccione un profesor</option>
            <?php foreach ($profesores as $profesor): ?>
                <option value="<?= htmlspecialchars($profesor['id']) ?>">
                    <?= htmlspecialchars($profesor['nombre_completo']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <?php
        $contador = 1;
       foreach ($preguntas_bd as $index => $pregunta) {
    echo '<div class="pregunta">';
    echo "<p><strong>" . htmlspecialchars($pregunta['texto']) . "</strong></p>";

    // Si la pregunta es la del comentario, poner textarea
    if (strpos(strtolower($pregunta['texto']), 'comentario') !== false) {
        echo "<textarea name='pregunta{$pregunta['id']}' rows='4' cols='60' placeholder='Escribe aquí tu comentario...'></textarea>";
    } else {
        echo "<div class='opciones'>";

        // Calcular IDs de respuesta para esta pregunta
        $inicio = 77 + ($index * 4);
        $fin = $inicio + 3;

        $sqlRespuestas = "SELECT cvidTipoRespuesta, descripcionRespuesta 
                          FROM CvTipoRespuesta 
                          WHERE activo = 1 AND cvidTipoRespuesta BETWEEN ? AND ?";
        $paramsResp = array($inicio, $fin);
        $stmtRespuestas = sqlsrv_query($conexion_encuesta, $sqlRespuestas, $paramsResp);

        if ($stmtRespuestas === false) {
            die("❌ Error al cargar respuestas: " . print_r(sqlsrv_errors(), true));
        }

        while ($row = sqlsrv_fetch_array($stmtRespuestas, SQLSRV_FETCH_ASSOC)) {
            echo "<div class='opcion'>";
            echo "<label>";
            echo "<input type='radio' name='pregunta{$pregunta['id']}' value='{$row['cvidTipoRespuesta']}' required> " 
                 . htmlspecialchars($row['descripcionRespuesta']);
            echo "</label>";
            echo "</div>";
        }

        echo "</div>";
    }

    echo "</div>";
}


        ?>

         


        <button type="submit" class="btn-enviar">Enviar evaluación</button>

    </form>
</div>

<footer class="form-footer">
    Universidad Tecnológica de la Zona Metropolitana de Guadalajara © 2025 - Todos los derechos reservados 
</footer>

</body>
</html>
