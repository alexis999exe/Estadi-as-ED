<?php
// Simulamos las preguntas actuales (en producción vendrían de una base de datos)
$preguntas = [
    "El profesor explica claramente los temas.",
    "Muestra dominio del tema.",
    "Fomenta la participación en clase.",
    "Usa ejemplos prácticos para explicar.",
    "Se comunica de forma respetuosa.",
    "Está disponible para resolver dudas.",
    "Cumple con el programa de la materia.",
    "Evalúa de manera justa.",
    "Inicia y termina puntualmente las clases.",
    "Utiliza recursos didácticos adecuados.",
    "Motiva el aprendizaje del estudiante."
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Encuesta</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
      .contenedor {
    max-width: 1000px; /* Aumenta el ancho del formulario */
    margin: 40px auto;
    background: #fff;
    padding: 40px 60px; /* Espaciado interno suficiente */
    border-radius: 12px;
    box-shadow: 0 0 12px rgba(0,0,0,0.1);
    box-sizing: border-box;
}

        h2 {
            text-align: center;
            color: #7e1f1f;
        }
        .pregunta-editable {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }
        .pregunta-editable input[type="text"] {
            flex: 1;
            padding: 10px;
        }
        .pregunta-editable button {
            background-color: #c62828;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-guardar, .btn-agregar {
            background-color: #0073e6;
            color: white;
            padding: 12px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        .btn-guardar:hover, .btn-agregar:hover {
            background-color: #005bb5;
        }
    </style>
</head>
<body>

<header>
    <div class="contenedor-header">
        <img src="imagenes/LogoUTZMG.png" class="logo" alt="Logo UTZMG">
        <h1>Modificar Preguntas de Encuesta</h1>
    </div>
</header>

<main>
    <div class="contenedor">
        <h2>Editor de preguntas</h2>
        <form method="post" action="guardar_modificaciones.php">
            <?php foreach ($preguntas as $index => $pregunta): ?>
                <div class="pregunta-editable">
                    <input type="text" name="preguntas[]" value="<?= htmlspecialchars($pregunta) ?>" required>
                    <button type="button" onclick="eliminarPregunta(this)">Eliminar</button>
                </div>
            <?php endforeach; ?>

            <div id="nuevas-preguntas"></div>

            <button type="button" class="btn-agregar" onclick="agregarPregunta()">Agregar nueva pregunta</button>
            <br>
            <button type="submit" class="btn-guardar">Guardar cambios</button>
        </form>
    </div>
</main>

<footer>
    Universidad Tecnológica de la Zona Metropolitana de Guadalajara © 2025
</footer>

<script>
    function eliminarPregunta(boton) {
        boton.parentElement.remove();
    }

    function agregarPregunta() {
        const contenedor = document.getElementById('nuevas-preguntas');
        const div = document.createElement('div');
        div.className = 'pregunta-editable';
        div.innerHTML = `
            <input type="text" name="preguntas[]" placeholder="Nueva pregunta..." required>
            <button type="button" onclick="eliminarPregunta(this)">Eliminar</button>
        `;
        contenedor.appendChild(div);
    }
</script>

</body>
</html>
