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
        .barra-container {
            margin: 20px 0;
        }

        .etiqueta-carrera {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .barra-progreso {
            height: 25px;
            border-radius: 10px;
            background-color: #ccc;
            overflow: hidden;
            position: relative;
        }

        .barra-progreso-inner {
            height: 100%;
            background-color: #0073e6;
            transition: width 0.5s ease;
            text-align: right;
            padding-right: 10px;
            color: white;
            line-height: 25px;
            border-radius: 10px 0 0 10px;
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
    <h2>Avance por carrera 📊</h2>
    <?php foreach ($datos as $carrera => $info): 
        $porcentaje = calcularPorcentaje($info['contestadas'], $info['total']);
    ?>
        <div class="barra-container">
            <div class="etiqueta-carrera"><?php echo $carrera; ?> — <?php echo "{$info['contestadas']} / {$info['total']} ({$porcentaje}%)"; ?></div>
            <div class="barra-progreso">
                <div class="barra-progreso-inner" style="width: <?php echo $porcentaje; ?>%;">
                    <?php echo $porcentaje; ?>%
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <button class="btn-avanzar" onclick="window.location.href='admin.php'">Volver al inicio</button>
</main>

<footer>
    Universidad Tecnologíca de la zona metropolítana de Guadalajara © 2025 - Todos los derechos reservados
</footer>

</body>
</html>
