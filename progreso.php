<?php
// Simulación de datos — Reemplaza estos valores con consultas reales a la base de datos
$datos = [
    'LINM' => ['contestadas' => 75, 'total' => 160],
    'IDGS' => ['contestadas' => 45, 'total' => 120],
    'LPC'  => ['contestadas' => 60, 'total' => 240],
    'IMT'  => ['contestadas' => 50, 'total' => 200],
    'LGDT' => ['contestadas' => 30, 'total' => 200],
    'IEDS' => ['contestadas' => 20, 'total' => 100],
];

function calcularPorcentaje($contestadas, $total) {
    return $total > 0 ? round(($contestadas / $total) * 100) : 0;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Progreso de Evaluación</title>
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

        /* Estilos del contenedor principal (main) */
        main {
            flex-grow: 1; /* Permite que el contenedor principal ocupe todo el espacio disponible */
            max-width: 950px; /* **¡CAMBIO AQUÍ! Ancho un poco más grande para esta vista** */
            margin: 40px auto;
            background: #fff;
            padding: 40px 60px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            color: #7e1f1f;
            margin-bottom: 30px;
            font-size: 2em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px; /* Espacio entre texto y emoji */
        }

        /* --- Estilos de las Barras de Progreso --- */
        .barra-container {
            margin-bottom: 25px; /* Más espacio entre cada barra */
            background-color: #f9f9f9; /* Fondo ligero para cada contenedor de barra */
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05); /* Sombra sutil */
        }

        .barra-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .etiqueta-carrera {
            font-weight: bold;
            color: #555; /* Color de texto más suave */
            font-size: 1.1em;
        }

        .porcentaje-texto {
            font-weight: bold;
            color: #7e1f1f; /* Color de tu marca */
            font-size: 1.1em;
        }


        .barra-progreso {
            height: 28px; /* Un poco más alta */
            border-radius: 14px; /* Más redondeada */
            background-color: #e0e0e0; /* Fondo de la barra más suave */
            overflow: hidden;
            position: relative;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1); /* Sombra interna para profundidad */
        }

        .barra-progreso-inner {
            height: 100%;
            background-color: #7e1f1f; /* Color de tu marca (rojo) */
            /* Degradado sutil */
            background-image: linear-gradient(to right, #7e1f1f, #a03c3c);
            transition: width 0.6s ease-out; /* Transición más larga y suave */
            display: flex; /* Para centrar el texto dentro */
            align-items: center;
            justify-content: flex-end; /* Alinear el texto a la derecha */
            padding-right: 12px; /* Padding interno */
            color: white;
            font-weight: bold;
            font-size: 0.9em; /* Tamaño de fuente para el porcentaje dentro */
            border-radius: 14px 0 0 14px; /* Bordes redondeados en el inicio */
            min-width: 30px; /* Asegura que el porcentaje se vea si es muy pequeño */
        }

        /* Estilo para cuando el porcentaje es 0, para que el texto no se vea */
        .barra-progreso-inner[style*="width: 0%"] {
            padding-right: 0;
            color: transparent;
        }

        /* Botón de volver */
        .btn-volver {
            display: block;
            width: fit-content; /* Se ajusta al contenido */
            margin: 40px auto 0 auto; /* Centrar y margen superior */
            padding: 12px 25px;
            background-color: #555; /* Un gris oscuro para un botón neutral */
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1.1em;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15); /* Sombra más pronunciada */
        }

        .btn-volver:hover {
            background-color: #333;
            transform: translateY(-2px); /* Efecto de levantar */
            box-shadow: 0 6px 10px rgba(0,0,0,0.2);
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
        @media (max-width: 768px) {
            .contenedor-header .logo {
                height: 60px;
            }
            .contenedor-header h1 {
                font-size: 1.8em;
            }
            main {
                max-width: 90%; /* Ajuste para que no se pegue tanto a los bordes en tablets */
                padding: 25px 30px;
                margin: 20px auto;
            }
            h2 {
                font-size: 1.8em;
                margin-bottom: 25px;
            }
            .barra-container {
                padding: 10px;
                margin-bottom: 20px;
            }
            .etiqueta-carrera, .porcentaje-texto {
                font-size: 1em;
            }
            .barra-progreso {
                height: 25px;
            }
            .barra-progreso-inner {
                font-size: 0.85em;
                padding-right: 10px;
            }
        }

        @media (max-width: 480px) {
            .contenedor-header h1 {
                font-size: 1.5em;
            }
            main {
                padding: 15px 20px;
            }
            h2 {
                font-size: 1.5em;
                gap: 5px;
            }
            .etiqueta-carrera, .porcentaje-texto {
                font-size: 0.9em;
            }
            .barra-progreso {
                height: 22px;
            }
            .barra-progreso-inner {
                font-size: 0.8em;
                min-width: 25px;
            }
            .btn-volver {
                padding: 10px 20px;
                font-size: 1em;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="contenedor-header">
        <img src="imagenes/LogoUTZMG.png" alt="Logo de la Universidad" class="logo">
        <h1>Progreso de Evaluación Docente</h1>
    </div>
</header>

<main>
    <h2>Avance por carrera <span style="font-size: 1.2em;">📊</span></h2>
    <?php foreach ($datos as $carrera => $info):
        $porcentaje = calcularPorcentaje($info['contestadas'], $info['total']);
    ?>
        <div class="barra-container">
            <div class="barra-header">
                <div class="etiqueta-carrera"><?php echo $carrera; ?></div>
                <div class="porcentaje-texto"><?php echo "{$info['contestadas']} / {$info['total']} ({$porcentaje}%)"; ?></div>
            </div>
            <div class="barra-progreso">
                <div class="barra-progreso-inner" style="width: <?php echo $porcentaje; ?>%;">
                    <?php if ($porcentaje > 5): // Solo muestra el porcentaje si hay suficiente espacio ?>
                        <?php echo $porcentaje; ?>%
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <button class="btn-volver" onclick="window.location.href='admin.php'">Volver al inicio</button>
</main>

<footer>
    Universidad Tecnológica de la Zona Metropolitana de Guadalajara © 2025 - Todos los derechos reservados
</footer>

</body>
</html>