<?php
// Datos simulados de alumnos que no han contestado la encuesta
// En un entorno real, esta información vendría de tu base de datos de SQL Server,
// y la estructura de este array sería el resultado de cómo organizas tus datos después de la consulta.

// La estructura ahora es: Carrera -> Grupo -> Alumnos
$alumnos_por_carrera_grupo = [
    "Tecnologías de la Información" => [
        "3A" => [
            [
                "nombre" => "Juan Pérez",
                "matricula" => "TI123456",
                "grado" => "3",
                "grupo" => "A"
            ],
            [
                "nombre" => "María García",
                "matricula" => "TI789012",
                "grado" => "3",
                "grupo" => "A"
            ]
        ],
        "3B" => [
            [
                "nombre" => "Ana López",
                "matricula" => "TI654321",
                "grado" => "3",
                "grupo" => "B"
            ],
            [
                "nombre" => "Pedro Ramírez",
                "matricula" => "TI345678",
                "grado" => "3",
                "grupo" => "B"
            ]
        ],
        "2A" => [ // Grupo con alumnos
            [
                "nombre" => "Roberto Gómez",
                "matricula" => "TI987654",
                "grado" => "2",
                "grupo" => "A"
            ]
        ],
        "2B" => [] // Grupo sin alumnos
    ],
    "Mecatrónica" => [
        "2A" => [
            [
                "nombre" => "Carlos García",
                "matricula" => "MT987654",
                "grado" => "2",
                "grupo" => "A"
            ]
        ],
        "3C" => [
            [
                "nombre" => "Sofía Hernández",
                "matricula" => "MT112233",
                "grado" => "3",
                "grupo" => "C"
            ]
        ],
        "1A" => [] // Grupo sin alumnos
    ],
    "Desarrollo de Negocios" => [
        "1A" => [], // Carrera con grupos, pero todos sin alumnos pendientes
        "2A" => []
    ],
    // NUEVO: Paramedico y Protección Civil combinadas
    "Paramédico Protección Civil" => [
        "4A" => [
             [
                "nombre" => "Dr. House",
                "matricula" => "PPC123456",
                "grado" => "4",
                "grupo" => "A"
            ],
             [
                "nombre" => "Capitán América",
                "matricula" => "PPC654321",
                "grado" => "4",
                "grupo" => "A"
            ]
        ]
    ],
    // ENERGÍAS RENOVABLES DE NUEVO
    "Energías Renovables" => [
        "5B" => [
             [
                "nombre" => "Luis Morales",
                "matricula" => "ER123456",
                "grado" => "5",
                "grupo" => "B"
            ]
        ]
    ],
    "Turismo" => [
        "1A" => [
             [
                "nombre" => "Dora la Exploradora",
                "matricula" => "TR123456",
                "grado" => "1",
                "grupo" => "A"
            ]
        ]
    ]
];

// Mapeo de carreras a emojis
$carrera_emojis = [
    "Tecnologías de la Información" => "💻",
    "Mecatrónica" => "🤖",
    "Desarrollo de Negocios" => "📈",
    "Paramédico Protección Civil" => "🚑", // Nuevo emoji para la carrera combinada
    "Energías Renovables" => "♻️", // Emoji para Energías Renovables
    "Turismo" => "✈️"
];


// Función auxiliar para verificar si hay algún alumno en cualquier grupo/carrera
function hasAnyPendingStudents($data) {
    foreach ($data as $carreraData) {
        if (is_array($carreraData)) { // Asegurarse de que es un array de grupos
            foreach ($carreraData as $grupoData) {
                if (!empty($grupoData)) {
                    return true;
                }
            }
        }
    }
    return false;
}

$hasGlobalPendingStudents = hasAnyPendingStudents($alumnos_por_carrera_grupo);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alumnos sin Contestar</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        /* Estilos generales del body y layout para el footer fijo */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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
            display: flex; /* Usamos flexbox para el diseño del menú y contenido */
            flex-direction: column; /* Por defecto en columna, para que el menú se apile en móvil */
        }

        h2 {
            text-align: center;
            color: #7e1f1f;
            margin-bottom: 30px;
            font-size: 2em;
        }

        /* Contenedor para el menú y el contenido de la tabla */
        .content-area {
            display: flex;
            flex-grow: 1;
            gap: 30px; /* Espacio entre el menú y el contenido */
            flex-wrap: wrap; /* Permite que los elementos se envuelvan en pantallas pequeñas */
            justify-content: center; /* Centra el menú y el contenido horizontalmente */
        }

        /* Estilos del menú de carreras y grupos */
        .menu-carreras {
            flex: 0 0 280px; /* Ancho fijo para el menú en desktop */
            background-color: #f0f0f0; /* Color de fondo más suave */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            max-height: fit-content; /* Se ajusta a la altura del contenido */
        }

        .menu-carreras h3 {
            color: #7e1f1f;
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
            font-size: 1.5em;
            border-bottom: 1px solid #ddd; /* Borde más suave */
            padding-bottom: 10px;
        }

        .menu-carreras ul {
            list-style: none;
            padding: 0;
        }

        .menu-carreras ul li {
            margin-bottom: 8px; /* Espacio reducido entre ítems principales */
        }

        .menu-carreras ul li a.carrera-link,
        .menu-carreras ul li a.grupo-link {
            display: flex; /* Para alinear emoji y texto */
            align-items: center;
            padding: 10px 15px;
            background-color: #e0e0e0; /* Color base más suave */
            color: #444; /* Texto más oscuro pero no negro */
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
            font-size: 1em;
            cursor: pointer;
            position: relative;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05); /* Sombra sutil */
        }

        .menu-carreras ul li a.carrera-link:hover,
        .menu-carreras ul li a.grupo-link:hover {
            background-color: #d1d1d1; /* Un poco más oscuro al pasar el ratón */
            transform: translateY(-2px); /* Efecto de "levantar" */
        }

        .menu-carreras ul li a.carrera-link.active,
        .menu-carreras ul li a.grupo-link.active {
            background-color: #7e1f1f; /* Rojo de la marca cuando está activo */
            color: white;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2); /* Sombra más pronunciada al activo */
            transform: translateY(0); /* Reinicia la posición si estaba levantado */
        }

        .menu-carreras ul li a.carrera-link .emoji {
            margin-right: 10px; /* Espacio entre emoji y texto */
            font-size: 1.2em; /* Tamaño del emoji */
        }

        .menu-carreras ul li a.carrera-link::after {
            content: '+'; /* Icono de expansión */
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2em;
            transition: transform 0.3s ease;
        }

        .menu-carreras ul li a.carrera-link.active::after {
            content: '-';
            transform: translateY(-50%) rotate(0deg); /* Asegura que la rotación no afecte */
        }

        .submenu-grupos {
            list-style: none;
            padding: 0;
            padding-left: 25px; /* Más indentación para los grupos */
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-out; /* Transición más suave */
        }

        .submenu-grupos.open {
            max-height: 500px; /* Un valor lo suficientemente grande para mostrar todos los grupos */
            transition: max-height 0.6s ease-in; /* Transición de apertura más lenta para efecto de "expansión" */
        }

        .submenu-grupos li {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .submenu-grupos li a.grupo-link {
            background-color: #f7f7f7; /* Un color muy suave para los submenús */
            color: #555;
            padding: 8px 12px;
            font-size: 0.9em;
            box-shadow: none; /* Sin sombra en sub-ítems normales */
        }

        .submenu-grupos li a.grupo-link:hover {
            background-color: #e9e9e9;
            transform: translateY(-1px); /* Efecto más sutil para sub-ítems */
        }

        .submenu-grupos li a.grupo-link.active {
            background-color: #7e1f1f;
            color: white;
            font-weight: bold;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1); /* Sombra para el grupo activo */
        }


        /* Contenido de la tabla de alumnos */
        .alumnos-content {
            flex-grow: 1; /* Ocupa el espacio restante */
            min-width: 0; /* Permite que el contenido se encoja */
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            display: none; /* Oculto por defecto, se mostrará con JS */
            flex-direction: column;
        }

        .alumnos-content.active {
            display: flex;
        }

        .alumnos-content h4 {
            color: #7e1f1f;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 1.5em;
            text-align: center;
        }

        .table-container {
            overflow-x: auto; /* Permite el desplazamiento horizontal para tablas en pantallas pequeñas */
        }

        /* Estilos de la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background-color: #f2f2f2;
            color: #555;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .no-alumnos-message {
            text-align: center;
            padding: 20px;
            background-color: #ffe0b2;
            color: #e65100;
            border-radius: 8px;
            margin-top: 20px;
            font-weight: bold;
        }
        .no-selection-message {
            text-align: center;
            padding: 30px;
            color: #555;
            font-size: 1.2em;
            margin-top: 50px;
            border: 1px dashed #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }


        /* Estilos del footer */
        footer {
            background-color: #7e1f1f;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: auto; /* Empuja el footer hacia abajo */
            font-size: 0.9em;
            box-shadow: 0 -2px 4px rgba(0,0,0,0.1);
        }

        /* --- Media Queries para responsividad --- */

        /* Para pantallas más pequeñas (tablets y móviles) */
        @media (max-width: 768px) {
            .contenedor-header .logo {
                height: 60px;
                margin-right: 15px;
            }

            .contenedor-header h1 {
                font-size: 1.8em;
            }

            .contenedor {
                padding: 20px; /* Ajusta el padding general */
                flex-direction: column; /* Apila el menú y el contenido */
            }

            .content-area {
                flex-direction: column;
                gap: 20px;
                justify-content: flex-start; /* Resetea el centrado en móvil para apilado */
            }

            .menu-carreras {
                flex: 0 0 auto; /* Permite que el menú ocupe el ancho completo */
                width: 100%;
                margin-bottom: 20px; /* Espacio entre el menú y el contenido */
            }

            .alumnos-content {
                width: 100%; /* El contenido ocupa todo el ancho */
                padding: 15px; /* Ajusta el padding del contenido */
            }

            h2 {
                font-size: 1.7em;
                margin-bottom: 20px;
            }

            .alumnos-content h4 {
                font-size: 1.4em;
            }

            /* Estilos para la tabla responsiva en pantallas pequeñas */
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 8px;
                overflow: hidden;
            }

            td {
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
                text-align: right;
            }

            td:last-child {
                border-bottom: none;
            }

            td:before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: calc(50% - 20px);
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
                color: #555;
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
                padding: 15px;
            }

            h2 {
                font-size: 1.5em;
            }

            .alumnos-content h4 {
                font-size: 1.2em;
            }
            .menu-carreras h3 {
                font-size: 1.3em;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="contenedor-header">
        <img src="imagenes/LogoUTZMG.png" class="logo" alt="Logo UTZMG">
        <h1>Alumnos sin Contestar</h1>
    </div>
</header>

<div class="contenedor">
    <h2>Listado de Alumnos Pendientes por Grupo</h2>

    <?php if ($hasGlobalPendingStudents): ?>
        <div class="content-area">
            <aside class="menu-carreras">
                <h3>Selecciona una Carrera</h3>
                <ul>
                    <?php foreach ($alumnos_por_carrera_grupo as $carrera => $grupos):
                        // Obtener el emoji para la carrera actual
                        $emoji = $carrera_emojis[$carrera] ?? '🎓'; // Emoji por defecto si no se encuentra
                    ?>
                        <li>
                            <a href="#" class="carrera-link" data-carrera="<?php echo htmlspecialchars($carrera); ?>">
                                <span class="emoji"><?php echo $emoji; ?></span><?php echo htmlspecialchars($carrera); ?>
                            </a>
                            <ul class="submenu-grupos" id="submenu-<?php echo str_replace(' ', '-', $carrera); ?>">
                                <?php
                                $hasGroupsWithStudents = false;
                                foreach ($grupos as $grupo => $alumnos) {
                                    if (!empty($alumnos)) {
                                        $hasGroupsWithStudents = true;
                                        break;
                                    }
                                }

                                if ($hasGroupsWithStudents):
                                ?>
                                    <?php foreach ($grupos as $grupo => $alumnos):
                                        if (!empty($alumnos)): // Solo mostrar grupos con alumnos pendientes
                                    ?>
                                            <li>
                                                <a href="#" class="grupo-link" data-carrera="<?php echo htmlspecialchars($carrera); ?>" data-grupo="<?php echo htmlspecialchars($grupo); ?>">
                                                    Grupo <?php echo htmlspecialchars($grupo); ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li><span style="display: block; padding: 8px 12px; font-size: 0.9em; color: #888; background-color: #f0f0f0; border-radius: 5px;">No hay grupos con alumnos pendientes</span></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </aside>

            <main class="alumnos-content" id="alumnosDisplayArea">
                <p class="no-selection-message">Selecciona una carrera y un grupo del menú de la izquierda para ver los alumnos pendientes.</p>
                </main>
        </div>
    <?php else: ?>
        <p class="no-alumnos-message">
            ¡Felicidades! Todos los alumnos han contestado la encuesta o no hay registros pendientes en los grupos actualmente definidos.
        </p>
    <?php endif; ?>
</div>

<footer>
    Universidad Tecnológica de la Zona Metropolitana de Guadalajara © 2025
</footer>

<script>
    // Datos PHP pasados a JavaScript de forma segura
    const alumnosData = <?php echo json_encode($alumnos_por_carrera_grupo); ?>;
    const alumnosDisplayArea = document.getElementById('alumnosDisplayArea');
    let currentActiveCarreraLink = null;
    let currentActiveGrupoLink = null;

    // Función para manejar el click en los enlaces de Carrera
    document.querySelectorAll('.carrera-link').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Evitar que el enlace navegue

            const carrera = this.dataset.carrera;
            const submenuId = `submenu-${carrera.replace(/ /g, '-')}`;
            const submenu = document.getElementById(submenuId);

            // Cerrar el submenú actualmente abierto si hay uno diferente
            if (currentActiveCarreraLink && currentActiveCarreraLink !== this) {
                const prevCarrera = currentActiveCarreraLink.dataset.carrera;
                const prevSubmenu = document.getElementById(`submenu-${prevCarrera.replace(/ /g, '-')}`);
                prevSubmenu.classList.remove('open');
                currentActiveCarreraLink.classList.remove('active');
            }

            // Alternar la clase 'open' para mostrar/ocultar el submenú
            submenu.classList.toggle('open');
            this.classList.toggle('active');

            // Actualizar el enlace de carrera activo
            currentActiveCarreraLink = this;

            // Ocultar cualquier tabla de alumno visible
            alumnosDisplayArea.innerHTML = '<p class="no-selection-message">Selecciona una carrera y un grupo del menú de la izquierda para ver los alumnos pendientes.</p>';
            alumnosDisplayArea.classList.remove('active');

            // Quitar la clase 'active' de cualquier enlace de grupo activo
            if (currentActiveGrupoLink) {
                currentActiveGrupoLink.classList.remove('active');
                currentActiveGrupoLink = null;
            }
        });
    });

    // Función para manejar el click en los enlaces de Grupo
    document.querySelectorAll('.grupo-link').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Evitar que el enlace navegue

            const carrera = this.dataset.carrera;
            const grupo = this.dataset.grupo;

            // Quitar la clase 'active' de cualquier enlace de grupo previamente activo
            if (currentActiveGrupoLink) {
                currentActiveGrupoLink.classList.remove('active');
            }

            // Añadir la clase 'active' al enlace de grupo clickeado
            this.classList.add('active');
            currentActiveGrupoLink = this;

            displayAlumnos(carrera, grupo);
        });
    });

    // Función para mostrar los alumnos de un grupo específico
    function displayAlumnos(carrera, grupo) {
        let alumnosDelGrupo = [];
        if (alumnosData[carrera] && alumnosData[carrera][grupo]) {
            alumnosDelGrupo = alumnosData[carrera][grupo];
        }

        let htmlContent = `<h4>Alumnos sin Contestar: ${carrera} - Grupo ${grupo}</h4>`;

        if (alumnosDelGrupo.length > 0) {
            htmlContent += `
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Matrícula</th>
                                <th>Nombre</th>
                                <th>Grado</th>
                                <th>Grupo</th>
                            </tr>
                        </thead>
                        <tbody>
            `;
            alumnosDelGrupo.forEach(alumno => {
                htmlContent += `
                            <tr>
                                <td data-label="Matrícula">${alumno.matricula}</td>
                                <td data-label="Nombre">${alumno.nombre}</td>
                                <td data-label="Grado">${alumno.grado}</td>
                                <td data-label="Grupo">${alumno.grupo}</td>
                            </tr>
                `;
            });
            htmlContent += `
                        </tbody>
                    </table>
                </div>
            `;
        } else {
            htmlContent += `
                <p class="no-alumnos-message">Todos los alumnos del Grupo ${grupo} de ${carrera} han contestado la encuesta.</p>
            `;
        }
        alumnosDisplayArea.innerHTML = htmlContent;
        alumnosDisplayArea.classList.add('active');
    }

    // Al cargar la página, si no hay alumnos pendientes a nivel global, oculta el área de contenido y el menú
    document.addEventListener('DOMContentLoaded', () => {
        const hasGlobal = <?php echo json_encode($hasGlobalPendingStudents); ?>;
        if (!hasGlobal) {
            document.querySelector('.content-area').style.display = 'block'; // Mostrar como bloque para que el mensaje de "no alumnos" se vea bien
            document.querySelector('.menu-carreras').style.display = 'none'; // Ocultar el menú si no hay alumnos
        }
    });

</script>

</body>
</html>