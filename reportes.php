<!-- reportes.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportes de Encuesta</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        .contenedor {
            max-width: 1000px;
            margin: 40px auto;
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        .profesor {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
        }
        .profesor h3 {
            margin: 0 0 10px 0;
        }
        .profesor .acciones {
            display: flex;
            gap: 10px;
        }
        .acciones button {
            padding: 8px 16px;
            background: #0073e6;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .acciones button:hover {
            background: #005bb5;
        }
    </style>
</head>
<body>

<div class="contenedor">
    <h2>Reportes de Encuesta</h2>

    <!-- Lista de profesores -->
    <div class="profesor">
        <h3>María Pérez</h3>
        <div class="acciones">
            <button onclick="window.location.href='ver_reporte.php?profesor=1'">Ver Reporte</button>
            <button onclick="window.location.href='descargar_pdf.php?profesor=1'">Descargar PDF</button>
        </div>
    </div>

    <div class="profesor">
        <h3>Juan Rodríguez</h3>
        <div class="acciones">
            <button onclick="window.location.href='ver_reporte.php?profesor=2'">Ver Reporte</button>
            <button onclick="window.location.href='descargar_pdf.php?profesor=2'">Descargar PDF</button>
        </div>
    </div>
</div>

</body>
</html>
