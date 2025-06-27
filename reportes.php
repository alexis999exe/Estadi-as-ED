<?php
// En esta sección es donde se conectaría a la base de datos de SQL Server
// y se recuperarían los datos de los profesores.
// Por ahora, usaremos datos de ejemplo para que puedas ver la estructura de la tabla.

$profesores = [
    [
        'id' => 1,
        'nombre' => 'Juan Pérez',
        'promedio_encuesta' => 9.2
    ],
    [
        'id' => 2,
        'nombre' => 'María García',
        'promedio_encuesta' => 8.5
    ],
    [
        'id' => 3,
        'nombre' => 'Carlos López',
        'promedio_encuesta' => 7.9
    ],
    [
        'id' => 4,
        'nombre' => 'Ana Rodríguez',
        'promedio_encuesta' => 9.5
    ]
];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar reportes</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
       /* css/estilos.css (o añade estos estilos a tu sección <style> si la prefieres in-line) */

body {
    display: flex; /* Habilita Flexbox en el body */
    flex-direction: column; /* Organiza los elementos en una columna */
    min-height: 100vh; /* Asegura que el body ocupe al menos el 100% del alto de la ventana */
    margin: 0; /* Elimina el margen predeterminado del body */
    font-family: Arial, sans-serif; /* Fuente base */
    background-color: #f4f4f4; /* Un color de fondo suave para la página */
    color: #333;
}

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

input[type="text"].titulo {
    width: 100%;
    font-size: 18px;
    padding: 10px;
    margin-bottom: 30px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Estilos para la tabla */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 30px;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
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

.btn {
    padding: 8px 15px; /* Aumenta un poco el padding de los botones */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    text-decoration: none;
    display: inline-block;
    margin-right: 8px; /* Un poco más de margen entre botones */
    transition: background-color 0.3s ease; /* Transición suave para el hover */
}

.btn-details {
    background-color: #4CAF50; /* Verde */
    color: white;
}

.btn-details:hover {
    background-color: #45a049;
}

.btn-download {
    background-color: #008CBA; /* Azul */
    color: white;
}

.btn-download:hover {
    background-color: #007bb5;
}

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

    /* Asegúrate de que los botones tengan espacio */
    td:last-of-type {
        text-align: center; /* Centra los botones */
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
        line-height: 1.2; /* Ajusta la altura de línea */
    }

    .contenedor-header {
        justify-content: center; /* Centra el logo y el título en una sola línea si es posible */
    }

    .contenedor {
        padding: 15px 20px;
    }

    .btn {
        display: block; /* Hace que los botones se apilen verticalmente */
        width: calc(100% - 16px); /* Ancho completo menos el padding/margin */
        margin-bottom: 10px; /* Espacio entre botones apilados */
        margin-right: 0;
    }
}
    </style>
</head>
<body>

<header>
    <div class="contenedor-header">
        <img src="imagenes/LogoUTZMG.png" class="logo" alt="Logo UTZMG">
        <h1>Generar reportes</h1>
    </div>
</header>

<div class="contenedor">
    <h2>Profesores y Promedios de Encuesta</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre del Profesor</th>
                <th>Promedio de Encuesta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($profesores as $profesor): ?>
            <tr>
                <td><?php echo htmlspecialchars($profesor['nombre']); ?></td>
                <td><?php echo htmlspecialchars(number_format($profesor['promedio_encuesta'], 2)); ?></td>
                <td>
                    <a href="detalles_profesor.php?id=<?php echo htmlspecialchars($profesor['id']); ?>" class="btn btn-details">Ver detalles</a>
                    <a href="descargar_pdf.php?id=<?php echo htmlspecialchars($profesor['id']); ?>" class="btn btn-download">Descargar PDF</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($profesores)): ?>
            <tr>
                <td colspan="3">No hay profesores registrados.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<footer>
    Universidad Tecnológica de la Zona Metropolitana de Guadalajara © 2025
</footer>
</body>
</html>