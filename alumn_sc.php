<?php
// Datos simulados
$alumnos_por_carrera = [
    "Tecnologías de la Información" => [
        [
            "nombre" => "Juan Pérez",
            "grado" => "3",
            "grupo" => "A",
            "carrera" => "Tecnologías de la Información",
            "matricula" => "TI123456"
        ],
        [
            "nombre" => "Ana López",
            "grado" => "3",
            "grupo" => "B",
            "carrera" => "Tecnologías de la Información",
            "matricula" => "TI654321"
        ]
    ],
    "Mecatrónica" => [
        [
            "nombre" => "Carlos García",
            "grado" => "2",
            "grupo" => "A",
            "carrera" => "Mecatrónica",
            "matricula" => "MT987654"
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alumnos sin contestar</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        .contenedor {
            max-width: 1000px;
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
        }
        .carrera {
            margin-bottom: 30px;
        }
        .carrera h3 {
            color: #333;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        ul.lista-alumnos {
            list-style-type: none;
            padding: 0;
        }
        ul.lista-alumnos li {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }
        html, body {
    height: 100%;
    margin: 0;
}

body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.contenedor {
    flex: 1;
}

    </style>
</head>
<body>

<header>
    <div class="contenedor-header">
        <img src="imagenes/LogoUTZMG.png" class="logo" alt="Logo UTZMG">
        <h1>Alumnos sin contestar</h1>
    </div>
</header>

<div class="contenedor">
    <?php if (!empty($alumnos_por_carrera)): ?>
        <?php foreach ($alumnos_por_carrera as $carrera => $alumnos): ?>
            <div class="carrera">
                <h3><?php echo htmlspecialchars($carrera); ?></h3>
                <ul class="lista-alumnos">
                    <?php foreach ($alumnos as $alumno): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($alumno['nombre']); ?></strong> -
                            Grado: <?php echo htmlspecialchars($alumno['grado']); ?> -
                            Grupo: <?php echo htmlspecialchars($alumno['grupo']); ?> -
                            Matrícula: <?php echo htmlspecialchars($alumno['matricula']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay alumnos pendientes por contestar.</p>
    <?php endif; ?>
</div>

<footer>
    Universidad Tecnológica de la Zona Metropolitana de Guadalajara © 2025
</footer>

</body>
</html>
