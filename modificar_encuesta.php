<?php
// Simulación de datos — Reemplaza estos valores con consultas reales a la base de datos
// NOTA IMPORTANTE: La estructura de respuestas ahora incluye 'question_id' para vincularlas a una pregunta específica.

// Array de secciones, ahora con ID y estado para simular gestión
$sections = [
    ['id' => 1, 'name' => 'Planeación', 'active' => true],
    ['id' => 2, 'name' => 'Enseñanza-Aprendizaje', 'active' => true],
    ['id' => 3, 'name' => 'Juicio del Estudiante', 'active' => true],
];

$questions = [
    // --- 1. Planeación ---
    ['id' => 1, 'text' => 'El profesor presentó el encuadre de la materia (planeación del curso, objetivos y criterios de evaluación, reglas y acuerdo de voluntades) y lo dejó disponible para su consulta en una plataforma de aprendizaje (Classroom, Moodle, otras).', 'section_id' => 1, 'active' => true],
    ['id' => 2, 'text' => 'El profesor asiste puntualmente a clases e imparte la sesión completa.', 'section_id' => 1, 'active' => true],
    ['id' => 3, 'text' => 'El profesor sigue la planeación del curso.', 'section_id' => 1, 'active' => true],
    ['id' => 4, 'text' => 'El profesor respeta los criterios de evaluación establecidos al inicio del curso.', 'section_id' => 1, 'active' => true],

    // --- 2. Enseñanza-Aprendizaje ---
    ['id' => 5, 'text' => 'El profesor domina los temas de la asignatura y los explica de forma clara y comprensible.', 'section_id' => 2, 'active' => true],
    ['id' => 6, 'text' => 'El profesor utiliza métodos y estrategias que facilitan el aprendizaje.', 'section_id' => 2, 'active' => true],
    ['id' => 7, 'text' => 'El profesor fomenta la participación de los estudiantes en clase.', 'section_id' => 2, 'active' => true],
    ['id' => 8, 'text' => 'Durante el curso, se realizaron actividades prácticas y análisis de ejemplos que aportaron al saber hacer.', 'section_id' => 2, 'active' => true],
    ['id' => 9, 'text' => 'Durante el cuatrimestre, utilizaste herramientas tecnológicas que fomentaron tu aprendizaje.', 'section_id' => 2, 'active' => true],

    // --- 3. Juicio del Estudiante ---
    ['id' => 10, 'text' => 'El profesor mantiene una comunicación clara y respetuosa con los estudiantes.', 'section_id' => 3, 'active' => true],
    ['id' => 11, 'text' => '¿Tomarías otra materia con este profesor?', 'section_id' => 3, 'active' => true],
    // La pregunta de comentario libre no necesita respuestas precargadas.
    ['id' => 12, 'text' => '¿Te gustaría incluir un comentario felicitación o recomendación para el profesor?', 'section_id' => 3, 'active' => true],
];

// Datos de ejemplo para respuestas, ahora con 'question_id' para vincularlas a una pregunta.
$answers = [
    // Respuestas para Pregunta 1 (Encuadre)
    ['id' => 1, 'text' => 'Lo presentó de manera limitada o no lo dejó disponible.', 'ponderacion' => 7, 'question_id' => 1, 'active' => true],
    ['id' => 2, 'text' => 'Lo presentó, pero no lo dejó disponible en línea.', 'ponderacion' => 8, 'question_id' => 1, 'active' => true],
    ['id' => 3, 'text' => 'Lo presentó claramente y lo dejó disponible.', 'ponderacion' => 9, 'question_id' => 1, 'active' => true],
    ['id' => 4, 'text' => 'Lo presentó de forma clara, accesible y lo explicó detalladamente.', 'ponderacion' => 10, 'question_id' => 1, 'active' => true],

    // Respuestas para Pregunta 2 (Puntualidad)
    ['id' => 5, 'text' => 'Frecuentemente llega tarde, se retira antes de tiempo o falta sin aviso.', 'ponderacion' => 7, 'question_id' => 2, 'active' => true],
    ['id' => 6, 'text' => 'En ocasiones llega tarde o se retira antes, pero asiste regularmente.', 'ponderacion' => 8, 'question_id' => 2, 'active' => true],
    ['id' => 7, 'text' => 'Es puntual en la mayoría de las clases y generalmente imparte la sesión completa.', 'ponderacion' => 9, 'question_id' => 2, 'active' => true],
    ['id' => 8, 'text' => 'Siempre es puntual, cumple con su horario e imparte la sesión completa.', 'ponderacion' => 10, 'question_id' => 2, 'active' => true],

    // Respuestas para Pregunta 3 (Sigue planeación)
    ['id' => 9, 'text' => 'Se desvía constantemente del plan de curso.', 'ponderacion' => 7, 'question_id' => 3, 'active' => true],
    ['id' => 10, 'text' => 'Hace ajustes menores, pero sin justificar.', 'ponderacion' => 8, 'question_id' => 3, 'active' => true],
    ['id' => 11, 'text' => 'Sigue la planeación con ajustes mínimos y justificados.', 'ponderacion' => 9, 'question_id' => 3, 'active' => true],
    ['id' => 12, 'text' => 'Sigue rigurosamente la planeación del curso.', 'ponderacion' => 10, 'question_id' => 3, 'active' => true],

    // Respuestas para Pregunta 4 (Criterios evaluación)
    ['id' => 13, 'text' => 'Hubo cambios en los criterios sin aviso o justificación clara.', 'ponderacion' => 7, 'question_id' => 4, 'active' => true],
    ['id' => 14, 'text' => 'Se realizaron ajustes menores, pero sin justificar.', 'ponderacion' => 8, 'question_id' => 4, 'active' => true],
    ['id' => 15, 'text' => 'Se respetaron los criterios con ajustes mínimos y justificados.', 'ponderacion' => 9, 'question_id' => 4, 'active' => true],
    ['id' => 16, 'text' => 'Se respetaron completamente los criterios establecidos.', 'ponderacion' => 10, 'question_id' => 4, 'active' => true],

    // Respuestas para Pregunta 5 (Domina temas)
    ['id' => 17, 'text' => 'No domina ni explica con claridad.', 'ponderacion' => 7, 'question_id' => 5, 'active' => true],
    ['id' => 18, 'text' => 'Domina el tema, pero en ocasiones se necesita mayor claridad.', 'ponderacion' => 8, 'question_id' => 5, 'active' => true],
    ['id' => 19, 'text' => 'Domina el tema, explica bien, pero no resuelve todas las dudas.', 'ponderacion' => 9, 'question_id' => 5, 'active' => true],
    ['id' => 20, 'text' => 'Domina el tema, explica de forma clara y resuelve las dudas que surgen.', 'ponderacion' => 10, 'question_id' => 5, 'active' => true],

    // Respuestas para Pregunta 6 (Métodos)
    ['id' => 21, 'text' => 'Utiliza pocos métodos y estos no facilitan el aprendizaje.', 'ponderacion' => 7, 'question_id' => 6, 'active' => true],
    ['id' => 22, 'text' => 'Usa algunas estrategias, pero no en todos los temas.', 'ponderacion' => 8, 'question_id' => 6, 'active' => true],
    ['id' => 23, 'text' => 'Utiliza métodos variados que facilitan el aprendizaje.', 'ponderacion' => 9, 'question_id' => 6, 'active' => true],
    ['id' => 24, 'text' => 'Sus métodos son efectivos y facilitan el aprendizaje de manera significativa.', 'ponderacion' => 10, 'question_id' => 6, 'active' => true],

    // Respuestas para Pregunta 7 (Participación)
    ['id' => 25, 'text' => 'No fomenta la participación o solo unos pocos participan.', 'ponderacion' => 7, 'question_id' => 7, 'active' => true],
    ['id' => 26, 'text' => 'Motiva la participación, pero de forma limitada.', 'ponderacion' => 8, 'question_id' => 7, 'active' => true],
    ['id' => 27, 'text' => 'Fomenta la participación de la mayoría de los estudiantes.', 'ponderacion' => 9, 'question_id' => 7, 'active' => true],
    ['id' => 28, 'text' => 'Genera un ambiente en el que todos participan activamente.', 'ponderacion' => 10, 'question_id' => 7, 'active' => true],

    // Respuestas para Pregunta 8 (Actividades prácticas)
    ['id' => 29, 'text' => 'Hubo pocas actividades prácticas y análisis de ejemplos.', 'ponderacion' => 7, 'question_id' => 8, 'active' => true],
    ['id' => 30, 'text' => 'Se realizaron algunas actividades prácticas y análisis de ejemplos, pero pudieron ser más.', 'ponderacion' => 8, 'question_id' => 8, 'active' => true],
    ['id' => 31, 'text' => 'Se realizaron varias actividades prácticas y análisis de ejemplos bien estructurados.', 'ponderacion' => 9, 'question_id' => 8, 'active' => true],
    ['id' => 32, 'text' => 'Hubo muchas actividades prácticas y análisis de ejemplos que facilitaron el aprendizaje.', 'ponderacion' => 10, 'question_id' => 8, 'active' => true],

    // Respuestas para Pregunta 9 (Herramientas tecnológicas)
    ['id' => 33, 'text' => 'No pude utilizar herramientas tecnológicas.', 'ponderacion' => 7, 'question_id' => 9, 'active' => true],
    ['id' => 34, 'text' => 'Utilicé algunas herramientas, pero de forma limitada.', 'ponderacion' => 8, 'question_id' => 9, 'active' => true],
    ['id' => 35, 'text' => 'Utilicé herramientas tecnológicas que enriquecieron mi aprendizaje.', 'ponderacion' => 9, 'question_id' => 9, 'active' => true],
    ['id' => 36, 'text' => 'Pude integrar herramientas innovadoras de manera efectiva.', 'ponderacion' => 10, 'question_id' => 9, 'active' => true],

    // Respuestas para Pregunta 10 (Comunicación)
    ['id' => 37, 'text' => 'A veces la comunicación no es clara o el trato no es respetuoso.', 'ponderacion' => 7, 'question_id' => 10, 'active' => true],
    ['id' => 38, 'text' => 'Generalmente mantiene un trato respetuoso y se comunica bien, aunque ocasionalmente puede haber malentendidos o falta de claridad.', 'ponderacion' => 8, 'question_id' => 10, 'active' => true],
    ['id' => 39, 'text' => 'Se comunica de manera clara y respetuosa con todos los alumnos.', 'ponderacion' => 9, 'question_id' => 10, 'active' => true],
    ['id' => 40, 'text' => 'La comunicación es excelente, clara y respetuosa en todo momento.', 'ponderacion' => 10, 'question_id' => 10, 'active' => true],

    // Respuestas para Pregunta 11 (¿Tomarías otra materia?)
    ['id' => 41, 'text' => 'Sí', 'ponderacion' => 0, 'question_id' => 11, 'active' => true],
    ['id' => 42, 'text' => 'No', 'ponderacion' => 0, 'question_id' => 11, 'active' => true],
];

// Función auxiliar para obtener el texto de la pregunta dado su ID
function getQuestionTextById($id, $questions) {
    foreach ($questions as $q) {
        if ($q['id'] == $id) {
            return htmlspecialchars($q['text']);
        }
    }
    return 'N/A'; // No encontrada
}

// Función auxiliar para obtener el nombre de la sección dado su ID
function getSectionNameById($id, $sections) {
    foreach ($sections as $s) {
        if ($s['id'] == $id) {
            return htmlspecialchars($s['name']);
        }
    }
    return 'N/A'; // No encontrada
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Encuesta</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        /* Estilos generales del body y layout para el footer fijo */
        body {
            display: flex; /* Habilita Flexbox en el body */
            flex-direction: column; /* Organiza los elementos en una columna */
            min-height: 100vh; /* Asegura que el body ocupe al menos el 100% del alto de la ventana */
            margin: 0; /* Elimina el margen predeterminado del body */
            font-family: Arial, sans-serif; /* Fuente base */
            background-color: #f4f4f4; /* Un color de fondo suave para la página */
            color: #333;
        }

        /* Estilos del encabezado */
        header {
            background-color: #7e1f1f; /* Color de tu header */
            color: white;
            padding: 15px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .contenedor-header {
            max-width: 1000px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center; /* Centra los elementos */
            padding: 0 20px; /* Padding para evitar que el contenido toque los bordes */
            flex-wrap: wrap; /* Permite que los elementos se envuelvan en pantallas pequeñas */
        }

        .contenedor-header .logo {
            height: 80px; /* Ajusta el tamaño del logo si es necesario */
            margin-right: 20px;
        }

        .contenedor-header h1 {
            margin: 0;
            font-size: 2.2em; /* Tamaño de fuente para el título */
            text-align: center; /* Centrar el texto si se envuelve */
        }

        /* Estilos del contenedor principal */
        .contenedor {
            flex-grow: 1; /* Permite que el contenedor principal ocupe todo el espacio disponible */
            max-width: 1000px;
            margin: 40px auto;
            background: #fff;
            padding: 40px 60px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            box-sizing: border-box;
        }

        h2, h3 {
            text-align: center;
            color: #7e1f1f;
            margin-bottom: 30px;
        }

        /* Estilos de botones generales */
        .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            text-decoration: none;
            display: inline-block;
            margin: 5px; /* Ajusta el margen para el espacio entre botones */
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-primary { /* Para botones de "Agregar" o "Activar" */
            background-color: #4CAF50; /* Verde */
            color: white;
        }
        .btn-primary:hover {
            background-color: #45a049;
            transform: translateY(-2px);
        }

        .btn-secondary { /* Para botones de "Editar" */
            background-color: #008CBA; /* Azul */
            color: white;
        }
        .btn-secondary:hover {
            background-color: #007bb5;
            transform: translateY(-2px);
        }

        .btn-danger { /* Para botones de "Desactivar" */
            background-color: #f44336; /* Rojo */
            color: white;
        }
        .btn-danger:hover {
            background-color: #da190b;
            transform: translateY(-2px);
        }

        /* Estilos para los encabezados de sección y grupos de botones */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .section-header h3 {
            margin: 0;
            text-align: left; /* Alinea el título de sección a la izquierda */
            color: #7e1f1f;
        }

        .table-container {
            margin-top: 20px;
            overflow-x: auto; /* Permite el desplazamiento horizontal para tablas en pantallas pequeñas */
        }

        /* Estilos de la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            vertical-align: middle; /* Alineación vertical para el contenido de la celda */
        }

        th {
            background-color: #f2f2f2;
            color: #555;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9; /* Color de fondo para filas pares */
        }

        tr:hover {
            background-color: #f1f1f1; /* Efecto hover en las filas */
        }

        /* Estilos para el estado Activo/Inactivo */
        .status-active {
            color: #4CAF50; /* Verde para activo */
            font-weight: bold;
        }

        .status-inactive {
            color: #f44336; /* Rojo para inactivo */
            font-weight: bold;
        }

        /* Estilos del footer */
        footer {
            background-color: #7e1f1f;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: auto; /* Empuja el footer hacia abajo, funciona con flex-grow en .contenedor */
            font-size: 0.9em;
            box-shadow: 0 -2px 4px rgba(0,0,0,0.1);
        }

        /* --- Estilos para la Modal (Ventana Emergente) --- */
        .modal {
            display: none; /* Oculto por defecto */
            position: fixed; /* Posición fija para que cubra toda la pantalla */
            z-index: 1000; /* Asegura que esté por encima de otros elementos */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; /* Habilita scroll si el contenido es demasiado grande */
            background-color: rgba(0,0,0,0.4); /* Fondo semi-transparente oscuro */
            justify-content: center; /* Centra el contenido de la modal horizontalmente */
            align-items: center; /* Centra el contenido de la modal verticalmente */
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto; /* Para centrar si no se usa flexbox en .modal */
            padding: 30px;
            border: 1px solid #888;
            width: 80%; /* Ancho de la modal */
            max-width: 600px; /* Ancho máximo para evitar que sea demasiado grande en pantallas amplias */
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            position: relative; /* Necesario para el botón de cerrar */
            animation-name: animatetop;
            animation-duration: 0.4s;
        }

        /* Animación para que la modal aparezca desde arriba */
        @keyframes animatetop {
            from {top: -300px; opacity: 0}
            to {top: 0; opacity: 1}
        }

        .close-button {
            color: #aaa;
            float: right; /* Para posicionar el botón de cerrar a la derecha */
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 20px;
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-content h3 {
            color: #7e1f1f;
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8em;
        }

        .modal-content label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        .modal-content input[type="text"],
        .modal-content textarea,
        .modal-content select { /* Añadido para el campo select de ponderación y sección */
            width: calc(100% - 22px); /* Ancho completo menos padding y borde */
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            box-sizing: border-box; /* Asegura que padding y border se incluyan en el ancho */
        }

        .modal-content textarea {
            resize: vertical; /* Permite redimensionar verticalmente */
            min-height: 80px;
        }

        .modal-buttons {
            text-align: right; /* Alinea los botones al final del formulario */
            margin-top: 20px;
        }

        .modal-buttons .btn {
            margin-left: 10px;
        }

        /* --- Media Queries para responsividad --- */

        /* Para pantallas más pequeñas (tablets y móviles) */
        @media (max-width: 768px) {
            .contenedor-header .logo {
                height: 60px; /* Reduce el tamaño del logo */
                margin-right: 15px;
            }

            .contenedor-header h1 {
                font-size: 1.8em; /* Reduce el tamaño del título */
            }

            .contenedor {
                padding: 20px 30px; /* Reduce el padding del contenedor principal */
                margin: 20px auto; /* Ajusta el margen */
            }

            .section-header {
                flex-direction: column; /* Apila el título y los botones verticalmente */
                align-items: flex-start;
            }

            .section-header .button-group {
                margin-top: 15px; /* Espacio entre el título y los botones */
                width: 100%; /* El grupo de botones ocupa todo el ancho */
                text-align: left;
            }

            .btn {
                width: calc(100% - 10px); /* Los botones ocupan casi todo el ancho, ajustando por margen */
                margin-bottom: 10px;
                margin-left: 0;
                margin-right: 0;
            }
            .btn:last-child {
                margin-bottom: 0; /* No hay margen inferior en el último botón para evitar doble espaciado */
            }

            /* Estilos para la tabla responsiva en pantallas pequeñas */
            table, thead, tbody, th, td, tr {
                display: block; /* Hace que los elementos de la tabla se comporten como bloques */
            }

            thead tr {
                position: absolute;
                top: -9999px; /* Oculta la cabecera original */
                left: -9999px;
            }

            tr {
                margin-bottom: 15px; /* Espacio entre filas */
                border: 1px solid #ddd;
                border-radius: 8px;
                overflow: hidden; /* Asegura que el border-radius se aplique bien */
            }

            td {
                border: none; /* Elimina los bordes de las celdas individuales */
                border-bottom: 1px solid #eee; /* Agrega un borde inferior para separar visualmente */
                position: relative;
                padding-left: 50%; /* Espacio para el pseudo-elemento */
                text-align: right;
            }

            td:last-child {
                border-bottom: none; /* No hay borde inferior en la última celda */
            }

            td:before {
                content: attr(data-label); /* Usa el atributo data-label para mostrar el encabezado */
                position: absolute;
                left: 10px;
                width: calc(50% - 20px); /* Ancho para el label */
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
                color: #555;
            }

            /* Ajuste de modal para móviles */
            .modal-content {
                width: 95%; /* Hace la modal casi de ancho completo en móviles */
                padding: 15px;
            }
        }

        /* Para pantallas aún más pequeñas (móviles) */
        @media (max-width: 480px) {
            .contenedor-header .logo {
                height: 50px;
                margin-right: 10px;
            }

            .contenedor-header h1 {
                font-size: 1.5em;
                line-height: 1.2;
            }

            .contenedor {
                padding: 15px 20px;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="contenedor-header">
        <img src="imagenes/LogoUTZMG.png" class="logo" alt="Logo UTZMG">
        <h1>Modificar Encuesta</h1>
    </div>
</header>

<div class="contenedor">
    <h2>Administrar Preguntas y Respuestas de la Encuesta</h2>

    ---

    <h3>Sección de Secciones</h3>
    <div class="section-header">
        <div class="button-group">
            <button class="btn btn-primary" onclick="openModal('addSection')">Agregar Sección</button>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de Sección</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sections)): ?>
                    <?php foreach ($sections as $section): ?>
                    <tr>
                        <td data-label="ID"><?php echo htmlspecialchars($section['id']); ?></td>
                        <td data-label="Nombre de Sección"><?php echo htmlspecialchars($section['name']); ?></td>
                        <td data-label="Estado">
                            <span class="<?php echo $section['active'] ? 'status-active' : 'status-inactive'; ?>">
                                <?php echo $section['active'] ? 'Activa' : 'Inactiva'; ?>
                            </span>
                        </td>
                        <td data-label="Acciones">
                            <button class="btn btn-secondary" onclick="openModal('editSection', <?php echo htmlspecialchars(json_encode($section)); ?>)">Editar</button>
                            <?php if ($section['active']): ?>
                                <button class="btn btn-danger" onclick="openModal('confirmDeactivateSection', <?php echo htmlspecialchars($section['id']); ?>)">Desactivar</button>
                            <?php else: ?>
                                <button class="btn btn-primary" onclick="openModal('confirmActivateSection', <?php echo htmlspecialchars($section['id']); ?>)">Activar</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No hay secciones registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    ---

    <h3>Sección de Preguntas</h3>
    <div class="section-header">
        <div class="button-group">
            <button class="btn btn-primary" onclick="openModal('addQuestion')">Agregar Pregunta</button>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sección</th>
                    <th>Pregunta</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($questions)): ?>
                    <?php foreach ($questions as $question): ?>
                    <tr>
                        <td data-label="ID"><?php echo htmlspecialchars($question['id']); ?></td>
                        <td data-label="Sección"><?php echo getSectionNameById($question['section_id'], $sections); ?></td>
                        <td data-label="Pregunta"><?php echo htmlspecialchars($question['text']); ?></td>
                        <td data-label="Estado">
                            <span class="<?php echo $question['active'] ? 'status-active' : 'status-inactive'; ?>">
                                <?php echo $question['active'] ? 'Activa' : 'Inactiva'; ?>
                            </span>
                        </td>
                        <td data-label="Acciones">
                            <button class="btn btn-secondary" onclick="openModal('editQuestion', <?php echo htmlspecialchars(json_encode($question)); ?>)">Editar</button>
                            <?php if ($question['active']): ?>
                                <button class="btn btn-danger" onclick="openModal('confirmDeactivateQuestion', <?php echo htmlspecialchars($question['id']); ?>)">Desactivar</button>
                            <?php else: ?>
                                <button class="btn btn-primary" onclick="openModal('confirmActivateQuestion', <?php echo htmlspecialchars($question['id']); ?>)">Activar</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No hay preguntas registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    ---

    <h3>Sección de Respuestas</h3>
    <div class="section-header">
        <div class="button-group">
            <button class="btn btn-primary" onclick="openModal('addAnswer')">Agregar Respuesta</button>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Respuesta</th>
                    <th>Ponderación</th>
                    <th>Pregunta Correspondiente</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($answers)): ?>
                    <?php foreach ($answers as $answer): ?>
                    <tr>
                        <td data-label="ID"><?php echo htmlspecialchars($answer['id']); ?></td>
                        <td data-label="Respuesta"><?php echo htmlspecialchars($answer['text']); ?></td>
                        <td data-label="Ponderación"><?php echo htmlspecialchars($answer['ponderacion']); ?></td>
                        <td data-label="Pregunta Correspondiente">
                            <?php echo getQuestionTextById($answer['question_id'], $questions); ?>
                        </td>
                        <td data-label="Estado">
                            <span class="<?php echo $answer['active'] ? 'status-active' : 'status-inactive'; ?>">
                                <?php echo $answer['active'] ? 'Activa' : 'Inactiva'; ?>
                            </span>
                        </td>
                        <td data-label="Acciones">
                            <button class="btn btn-secondary" onclick="openModal('editAnswer', <?php echo htmlspecialchars(json_encode($answer)); ?>)">Editar</button>
                            <?php if ($answer['active']): ?>
                                <button class="btn btn-danger" onclick="openModal('confirmDeactivateAnswer', <?php echo htmlspecialchars($answer['id']); ?>)">Desactivar</button>
                            <?php else: ?>
                                <button class="btn btn-primary" onclick="openModal('confirmActivateAnswer', <?php echo htmlspecialchars($answer['id']); ?>)">Activar</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No hay respuestas registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<footer>
    Universidad Tecnológica de la Zona Metropolitana de Guadalajara © 2025
</footer>

<div id="addSectionModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('addSectionModal')">&times;</span>
        <h3>Agregar Nueva Sección</h3>
        <form action="procesar_seccion.php" method="POST">
            <input type="hidden" name="action" value="add">
            <label for="newSectionName">Nombre de la sección:</label>
            <input type="text" id="newSectionName" name="section_name" required>
            <div class="modal-buttons">
                <button type="submit" class="btn btn-primary">Guardar Sección</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal('addSectionModal')">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<div id="editSectionModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('editSectionModal')">&times;</span>
        <h3>Editar Sección</h3>
        <form action="procesar_seccion.php" method="POST">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" id="editSectionId" name="section_id">
            <label for="editSectionName">Nombre de la sección:</label>
            <input type="text" id="editSectionName" name="section_name" required>
            <div class="modal-buttons">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal('editSectionModal')">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<div id="confirmDeactivateSectionModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('confirmDeactivateSectionModal')">&times;</span>
        <h3>Confirmar Desactivación</h3>
        <p>¿Estás seguro de que quieres **desactivar** esta sección?</p>
        <p>Esto afectará a las preguntas asociadas a esta sección.</p>
        <div class="modal-buttons">
            <form action="procesar_seccion.php" method="POST" style="display:inline;">
                <input type="hidden" name="action" value="deactivate">
                <input type="hidden" id="deactivateSectionId" name="section_id">
                <button type="submit" class="btn btn-danger">Sí, Desactivar</button>
            </form>
            <button type="button" class="btn btn-secondary" onclick="closeModal('confirmDeactivateSectionModal')">Cancelar</button>
        </div>
    </div>
</div>

<div id="confirmActivateSectionModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('confirmActivateSectionModal')">&times;</span>
        <h3>Confirmar Activación</h3>
        <p>¿Estás seguro de que quieres **activar** esta sección?</p>
        <div class="modal-buttons">
            <form action="procesar_seccion.php" method="POST" style="display:inline;">
                <input type="hidden" name="action" value="activate">
                <input type="hidden" id="activateSectionId" name="section_id">
                <button type="submit" class="btn btn-primary">Sí, Activar</button>
            </form>
            <button type="button" class="btn btn-secondary" onclick="closeModal('confirmActivateSectionModal')">Cancelar</button>
        </div>
    </div>
</div>


<div id="addQuestionModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('addQuestionModal')">&times;</span>
        <h3>Agregar Nueva Pregunta</h3>
        <form action="procesar_pregunta.php" method="POST">
            <input type="hidden" name="action" value="add">
            <label for="newQuestionSectionId">Sección:</label>
            <select id="newQuestionSectionId" name="section_id" required>
                </select>
            <label for="newQuestionText">Texto de la pregunta:</label>
            <textarea id="newQuestionText" name="question_text" required></textarea>
            <div class="modal-buttons">
                <button type="submit" class="btn btn-primary">Guardar Pregunta</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal('addQuestionModal')">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<div id="editQuestionModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('editQuestionModal')">&times;</span>
        <h3>Editar Pregunta</h3>
        <form action="procesar_pregunta.php" method="POST">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" id="editQuestionId" name="question_id">
            <label for="editQuestionSectionId">Sección:</label>
            <select id="editQuestionSectionId" name="section_id" required>
                </select>
            <label for="editQuestionText">Texto de la pregunta:</label>
            <textarea id="editQuestionText" name="question_text" required></textarea>
            <div class="modal-buttons">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal('editQuestionModal')">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<div id="confirmDeactivateQuestionModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('confirmDeactivateQuestionModal')">&times;</span>
        <h3>Confirmar Desactivación</h3>
        <p>¿Estás seguro de que quieres **desactivar** esta pregunta?</p>
        <p>Esto hará que no aparezca en nuevas encuestas, pero su historial de respuestas se mantendrá.</p>
        <div class="modal-buttons">
            <form action="procesar_pregunta.php" method="POST" style="display:inline;">
                <input type="hidden" name="action" value="deactivate">
                <input type="hidden" id="deactivateQuestionId" name="question_id">
                <button type="submit" class="btn btn-danger">Sí, Desactivar</button>
            </form>
            <button type="button" class="btn btn-secondary" onclick="closeModal('confirmDeactivateQuestionModal')">Cancelar</button>
        </div>
    </div>
</div>

<div id="confirmActivateQuestionModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('confirmActivateQuestionModal')">&times;</span>
        <h3>Confirmar Activación</h3>
        <p>¿Estás seguro de que quieres **activar** esta pregunta?</p>
        <p>Esto hará que vuelva a aparecer en nuevas encuestas.</p>
        <div class="modal-buttons">
            <form action="procesar_pregunta.php" method="POST" style="display:inline;">
                <input type="hidden" name="action" value="activate">
                <input type="hidden" id="activateQuestionId" name="question_id">
                <button type="submit" class="btn btn-primary">Sí, Activar</button>
            </form>
            <button type="button" class="btn btn-secondary" onclick="closeModal('confirmActivateQuestionModal')">Cancelar</button>
        </div>
    </div>
</div>

<div id="addAnswerModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('addAnswerModal')">&times;</span>
        <h3>Agregar Nueva Respuesta</h3>
        <form action="procesar_respuesta.php" method="POST">
            <input type="hidden" name="action" value="add">
            <label for="newAnswerText">Texto de la respuesta:</label>
            <input type="text" id="newAnswerText" name="answer_text" required>

            <label for="newAnswerPonderacion">Ponderación (7-10 o 0 para Sí/No):</label>
            <select id="newAnswerPonderacion" name="answer_ponderacion" required>
                <option value="10">10</option>
                <option value="9">9</option>
                <option value="8">8</option>
                <option value="7">7</option>
                <option value="0">0 (Sí/No)</option>
            </select>

            <label for="newAnswerQuestionId">Pregunta Correspondiente:</label>
            <select id="newAnswerQuestionId" name="question_id" required>
                </select>

            <div class="modal-buttons">
                <button type="submit" class="btn btn-primary">Guardar Respuesta</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal('addAnswerModal')">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<div id="editAnswerModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('editAnswerModal')">&times;</span>
        <h3>Editar Respuesta</h3>
        <form action="procesar_respuesta.php" method="POST">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" id="editAnswerId" name="answer_id">
            <label for="editAnswerText">Texto de la respuesta:</label>
            <input type="text" id="editAnswerText" name="answer_text" required>

            <label for="editAnswerPonderacion">Ponderación (7-10 o 0 para Sí/No):</label>
            <select id="editAnswerPonderacion" name="answer_ponderacion" required>
                <option value="10">10</option>
                <option value="9">9</option>
                <option value="8">8</option>
                <option value="7">7</option>
                <option value="0">0 (Sí/No)</option>
            </select>

            <label for="editAnswerQuestionId">Pregunta Correspondiente:</label>
            <select id="editAnswerQuestionId" name="question_id" required>
                </select>

            <div class="modal-buttons">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal('editAnswerModal')">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<div id="confirmDeactivateAnswerModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('confirmDeactivateAnswerModal')">&times;</span>
        <h3>Confirmar Desactivación</h3>
        <p>¿Estás seguro de que quieres **desactivar** esta respuesta?</p>
        <div class="modal-buttons">
            <form action="procesar_respuesta.php" method="POST" style="display:inline;">
                <input type="hidden" name="action" value="deactivate">
                <input type="hidden" id="deactivateAnswerId" name="answer_id">
                <button type="submit" class="btn btn-danger">Sí, Desactivar</button>
            </form>
            <button type="button" class="btn btn-secondary" onclick="closeModal('confirmDeactivateAnswerModal')">Cancelar</button>
        </div>
    </div>
</div>

<div id="confirmActivateAnswerModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('confirmActivateAnswerModal')">&times;</span>
        <h3>Confirmar Activación</h3>
        <p>¿Estás seguro de que quieres **activar** esta respuesta?</p>
        <div class="modal-buttons">
            <form action="procesar_respuesta.php" method="POST" style="display:inline;">
                <input type="hidden" name="action" value="activate">
                <input type="hidden" id="activateAnswerId" name="answer_id">
                <button type="submit" class="btn btn-primary">Sí, Activar</button>
            </form>
            <button type="button" class="btn btn-secondary" onclick="closeModal('confirmActivateAnswerModal')">Cancelar</button>
        </div>
    </div>
</div>


<script>
    // Se obtiene los datos desde PHP para usarlos en JavaScript
    const allSections = <?php echo json_encode($sections); ?>;
    const allQuestions = <?php echo json_encode($questions); ?>;

    // Función para poblar el select de secciones en las modales de pregunta
    function populateSectionSelect(selectElementId, selectedSectionId = null) {
        const selectElement = document.getElementById(selectElementId);
        selectElement.innerHTML = ''; // Limpiar opciones existentes

        // Añadir una opción por defecto si no hay una sección seleccionada
        if (!selectedSectionId) {
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Selecciona una sección';
            defaultOption.disabled = true;
            defaultOption.selected = true;
            selectElement.appendChild(defaultOption);
        }

        allSections.forEach(section => {
            const option = document.createElement('option');
            option.value = section.id;
            option.textContent = section.name;
            if (selectedSectionId === section.id) {
                option.selected = true;
            }
            selectElement.appendChild(option);
        });
    }

    // Función para poblar el select de preguntas en las modales de respuesta
    function populateQuestionSelect(selectElementId, selectedQuestionId = null) {
        const selectElement = document.getElementById(selectElementId);
        selectElement.innerHTML = ''; // Limpiar opciones existentes

        // Añadir una opción por defecto si no hay una pregunta seleccionada
        if (!selectedQuestionId) {
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Selecciona una pregunta';
            defaultOption.disabled = true;
            defaultOption.selected = true;
            selectElement.appendChild(defaultOption);
        }

        allQuestions.forEach(question => {
            // Excluir la pregunta de comentario libre (ID 12 en este ejemplo) si no quieres asignarle respuestas
            // if (question.id === 12) return; // Descomenta esta línea si no quieres que la pregunta de comentario aparezca

            const option = document.createElement('option');
            option.value = question.id;
            // Buscar el nombre de la sección por ID para mostrarlo
            const sectionName = allSections.find(s => s.id === question.section_id)?.name || 'N/A';
            option.textContent = `[${sectionName}] ${question.text.substring(0, 70)}...`; // Mostrar sección y un fragmento del texto
            if (selectedQuestionId === question.id) {
                option.selected = true;
            }
            selectElement.appendChild(option);
        });
    }

    // Función para abrir una modal específica
    function openModal(modalType, data = null) {
        let modal;
        // Oculta todas las modales primero para evitar conflictos
        document.querySelectorAll('.modal').forEach(m => m.style.display = 'none');

        switch (modalType) {
            // Modales de SECCIONES
            case 'addSection':
                modal = document.getElementById('addSectionModal');
                document.getElementById('newSectionName').value = '';
                break;
            case 'editSection':
                modal = document.getElementById('editSectionModal');
                if (data) {
                    document.getElementById('editSectionId').value = data.id;
                    document.getElementById('editSectionName').value = data.name;
                }
                break;
            case 'confirmDeactivateSection':
                modal = document.getElementById('confirmDeactivateSectionModal');
                if (data) {
                    document.getElementById('deactivateSectionId').value = data;
                }
                break;
            case 'confirmActivateSection':
                modal = document.getElementById('confirmActivateSectionModal');
                if (data) {
                    document.getElementById('activateSectionId').value = data;
                }
                break;

            // Modales de PREGUNTAS
            case 'addQuestion':
                modal = document.getElementById('addQuestionModal');
                document.getElementById('newQuestionText').value = '';
                populateSectionSelect('newQuestionSectionId'); // Cargar secciones para seleccionar
                break;
            case 'editQuestion':
                modal = document.getElementById('editQuestionModal');
                if (data) {
                    document.getElementById('editQuestionId').value = data.id;
                    document.getElementById('editQuestionText').value = data.text;
                    populateSectionSelect('editQuestionSectionId', data.section_id); // Cargar y seleccionar la sección
                }
                break;
            case 'confirmDeactivateQuestion':
                modal = document.getElementById('confirmDeactivateQuestionModal');
                if (data) {
                    document.getElementById('deactivateQuestionId').value = data;
                }
                break;
            case 'confirmActivateQuestion':
                modal = document.getElementById('confirmActivateQuestionModal');
                if (data) {
                    document.getElementById('activateQuestionId').value = data;
                }
                break;

            // Modales de RESPUESTAS
            case 'addAnswer':
                modal = document.getElementById('addAnswerModal');
                document.getElementById('newAnswerText').value = '';
                document.getElementById('newAnswerPonderacion').value = '10';
                populateQuestionSelect('newAnswerQuestionId'); // Cargar preguntas para seleccionar
                break;
            case 'editAnswer':
                modal = document.getElementById('editAnswerModal');
                if (data) {
                    document.getElementById('editAnswerId').value = data.id;
                    document.getElementById('editAnswerText').value = data.text;
                    document.getElementById('editAnswerPonderacion').value = data.ponderacion;
                    populateQuestionSelect('editAnswerQuestionId', data.question_id); // Cargar y seleccionar la pregunta
                }
                break;
            case 'confirmDeactivateAnswer':
                modal = document.getElementById('confirmDeactivateAnswerModal');
                if (data) {
                    document.getElementById('deactivateAnswerId').value = data;
                }
                break;
            case 'confirmActivateAnswer':
                modal = document.getElementById('confirmActivateAnswerModal');
                if (data) {
                    document.getElementById('activateAnswerId').value = data;
                }
                break;
            default:
                console.error('Tipo de modal desconocido:', modalType);
                return;
        }

        if (modal) {
            modal.style.display = 'flex';
        }
    }

    // Función para cerrar una modal específica
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    // Cerrar la modal si se hace clic fuera del contenido de la modal
    window.onclick = function(event) {
        document.querySelectorAll('.modal').forEach(modal => {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    }
</script>

</body>
</html>