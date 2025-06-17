<?php
// Conexión a la base de datos UTZMG
$conexion = new mysqli("localhost", "root", "", "UTZMG");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener profesores (id, nombres y apellidos)
$sql = "SELECT id, nombres, apellidos FROM profesores";
$resultado = $conexion->query($sql);

$profesores = [];
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $profesores[] = [
            'id' => $fila['id'],
            'nombre_completo' => $fila['nombres'] . ' ' . $fila['apellidos']
        ];
    }
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
        $preguntas = [
            "Evaluación del Profesor" => [
                [
                    "texto" => "1. El profesor presentó el encuadre de la materia (planeación del curso, objetivos y criterios de evaluación, reglas y acuerdo de voluntades) y lo dejó disponible para su consulta en una plataforma de aprendizaje (Classroom, Moodle, otras).",
                    "ponderaciones" => [7, 8, 9, 10]
                ],
                [
                    "texto" => "2. El profesor asiste puntualmente a clases e imparte la sesión completa.",
                    "ponderaciones" => [7, 8, 9, 10]
                ],
                [
                    "texto" => "3. El profesor sigue la planeación del curso.",
                    "ponderaciones" => [7, 8, 9, 10]
                ],
                [
                    "texto" => "4. El profesor respeta los criterios de evaluación establecidos al inicio del curso.",
                    "ponderaciones" => [7, 8, 9, 10]
                ],
            ],
            "Enseñanza-Aprendizaje" => [
                [
                    "texto" => "5. El profesor domina los temas de la asignatura y los explica de forma clara y comprensible.",
                    "ponderaciones" => [7, 8, 9, 10]
                ],
                [
                    "texto" => "6. El profesor utiliza métodos y estrategias que facilitan el aprendizaje.",
                    "ponderaciones" => [7, 8, 9, 10]
                ],
                [
                    "texto" => "7. El profesor fomenta la participación de los estudiantes en clase.",
                    "ponderaciones" => [7, 8, 9, 10]
                ],
                [
                    "texto" => "8. Durante el curso, se realizaron actividades prácticas y análisis de ejemplos que aportaron al saber hacer.",
                    "ponderaciones" => [7, 8, 9, 10]
                ],
                [
                    "texto" => "9. Durante el cuatrimestre, utilizaste herramientas tecnológicas que fomentaron tu aprendizaje.",
                    "ponderaciones" => [7, 8, 9, 10]
                ],
            ],
            "Juicio del Estudiante" => [
                [
                    "texto" => "10. El profesor mantiene una comunicación clara y respetuosa con los estudiantes.",
                    "ponderaciones" => [7, 8, 9, 10]
                ],
                [
                    "texto" => "11. ¿Tomarías otra materia con este profesor?",
                    "opciones" => ["Sí", "No"]
                ]
            ]
        ];

        $opciones_texto = [
            "1" => [
                "Lo presentó de manera limitada o no lo dejó disponible.",
                "Lo presentó, pero no lo dejó disponible en línea.",
                "Lo presentó claramente y lo dejó disponible.",
                "Lo presentó de forma clara, accesible y lo explicó detalladamente."
            ],
            "2" => [
                "Frecuentemente llega tarde, se retira antes de tiempo o falta sin aviso.",
                "En ocasiones llega tarde o se retira antes, pero asiste regularmente.",
                "Es puntual en la mayoría de las clases y generalmente imparte la sesión completa.",
                "Siempre es puntual, cumple con su horario e imparte la sesión completa."
            ],
            "3" => [
                "Se desvía constantemente del plan de curso.",
                "Hace ajustes menores, pero sin justificar.",
                "Sigue la planeación con ajustes mínimos y justificados.",
                "Sigue rigurosamente la planeación del curso."
            ],
            "4" => [
                "Hubo cambios en los criterios sin aviso o justificación clara.",
                "Se realizaron ajustes menores, pero sin justificar.",
                "Se respetaron los criterios con ajustes mínimos y justificados.",
                "Se respetaron completamente los criterios establecidos."
            ],
            "5" => [
                "No domina ni explica con claridad.",
                "Domina el tema, pero en ocasiones se necesita mayor claridad.",
                "Domina el tema, explica bien, pero no resuelve todas las dudas.",
                "Domina el tema, explica de forma clara y resuelve las dudas que surgen."
            ],
            "6" => [
                "Utiliza pocos métodos y estos no facilitan el aprendizaje.",
                "Usa algunas estrategias, pero no en todos los temas.",
                "Utiliza métodos variados que facilitan el aprendizaje.",
                "Sus métodos son efectivos y facilitan el aprendizaje de manera significativa."
            ],
            "7" => [
                "No fomenta la participación o solo unos pocos participan.",
                "Motiva la participación, pero de forma limitada.",
                "Fomenta la participación de la mayoría de los estudiantes.",
                "Genera un ambiente en el que todos participan activamente."
            ],
            "8" => [
                "Hubo pocas actividades prácticas y análisis de ejemplos.",
                "Se realizaron algunas actividades prácticas y análisis de ejemplos, pero pudieron ser más.",
                "Se realizaron varias actividades prácticas y análisis de ejemplos bien estructurados.",
                "Hubo muchas actividades prácticas y análisis de ejemplos que facilitaron el aprendizaje."
            ],
            "9" => [
                "No pude utilizar herramientas tecnológicas.",
                "Utilicé algunas herramientas, pero de forma limitada.",
                "Utilicé herramientas tecnológicas que enriquecieron mi aprendizaje.",
                "Pude integrar herramientas innovadoras de manera efectiva."
            ],
            "10" => [
                "A veces la comunicación no es clara o el trato no es respetuoso.",
                "Generalmente mantiene un trato respetuoso y se comunica bien, aunque ocasionalmente puede haber malentendidos o falta de claridad.",
                "Se comunica de manera clara y respetuosa con todos los alumnos.",
                "La comunicación es excelente, clara y respetuosa en todo momento."
            ]
        ];

        $contador = 1;
        foreach ($preguntas as $seccion => $bloque) {
            echo "<h3>$seccion</h3>";
            foreach ($bloque as $pregunta) {
                echo '<div class="pregunta">';
                echo "<p><strong>{$pregunta['texto']}</strong></p>";
                echo "<div class='opciones'>";
                if (isset($pregunta['ponderaciones'])) {
                    $texto_opciones = $opciones_texto[$contador];
                    foreach ($pregunta['ponderaciones'] as $i => $valor) {
                        echo "<div class='opcion'>";
                        echo "<label>";
                        echo "<input type='radio' name='pregunta{$contador}' value='$valor' required> " . $texto_opciones[$i];
                        echo "</label>";
                        echo "</div>";
                    }
                } else {
                    foreach ($pregunta['opciones'] as $opcion) {
                        echo "<div class='opcion'>";
                        echo "<label>";
                        echo "<input type='radio' name='pregunta{$contador}' value='" . htmlspecialchars($opcion) . "' required> $opcion";
                        echo "</label>";
                        echo "</div>";
                    }
                }
                echo "</div>";
                echo '</div>';
                $contador++;
            }
        }
        ?>

        <div class="comentario-final">
            <p><strong> ¿Te gustaría incluir un comentario, felicitación o recomendación para el profesor?</strong></p>
            <textarea name="comentario" rows="5" placeholder="Escribe aquí tus observaciones, sugerencias o comentarios sobre el profesor..."></textarea>
        </div>

        <button type="submit" class="btn-enviar">Enviar evaluación</button>

    </form>
</div>

<footer class="form-footer">
    Universidad Tecnológica de la Zona Metropolitana de Guadalajara © 2025 - Todos los derechos reservados 
</footer>

</body>
</html>
