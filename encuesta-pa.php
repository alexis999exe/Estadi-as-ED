<?php
// Aquí más adelante puedes cargar los profesores desde una base de datos
$profesores = ["", "Mildred Green", "Cristina Moran", "Eva Lopez", "Brenda Mariana Casillas"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Evaluación presidente de academia</title>
    <link rel="stylesheet" href="css/estilos-f.css">
</head>
<body class="form-body">

    <div class="form-container">
        <!-- Encabezado con logo y título -->
        <div class="form-header">
            <img src="imagenes/logoUTZMG.png" alt="Logo UTZMG" class="logo-form">
            <h1>Formulario de Evaluación presidente acadamia UTZMG</h1>
        </div>

        <form action="guardar_respuestas.php" method="post" class="evaluation-form">

        <select id="profesor" name="profesor" required>
    <option value="" disabled selected>Seleccione un profesor</option>
    <?php foreach ($profesores as $profesor): ?>
        <?php if ($profesor !== ""): ?>
            <option value="<?= htmlspecialchars($profesor) ?>"><?= htmlspecialchars($profesor) ?></option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>

            <?php
            $preguntas = [
                "1. El profesor ?.",
                "2. Muestra dominio del tema.",
                "3. Fomenta la participación en clase.",
                "4. Usa ejemplos prácticos para explicar.",
                "5. Se comunica de forma respetuosa.",
                "6. Está disponible para resolver dudas.",
                "7. Cumple con el programa de la materia.",
                "8. Evalúa de manera justa.",
                "9. Inicia y termina puntualmente las clases.",
                "10. Utiliza recursos didácticos adecuados.",
                "11. Motiva el aprendizaje del estudiante."
            ];

            $opciones = ["Muy insatisfecho", "Insatisfecho", "Neutral", "Satisfecho", "Muy satisfecho"];

            foreach ($preguntas as $i => $pregunta): ?>
                <div class="pregunta">
                    <p><strong><?= $pregunta ?></strong></p>
                    <?php foreach ($opciones as $opcion): ?>
                        <label>
                            <input type="radio" name="respuesta<?= $i + 1 ?>" value="<?= $opcion ?>" required>
                            <?= $opcion ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            
            <!-- Campo para comentario adicional -->
            <div class="comentario-final">
                <p><strong>Comentario adicional (opcional):</strong></p>
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
