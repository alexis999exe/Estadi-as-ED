<?php
 ?>
 <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida - Evaluación Docente</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<header>
    <div class="contenedor-header">
        <img src="imagenes/LogoUTZMG.png" alt="Logo de la Universidad" class="logo">
        <h1>Encuesta de Evaluación Docente UTZMG</h1>
    </div>
    <div class="usuario-header">
        <span><?php echo htmlspecialchars($usuario); ?></span>
        <a href="logout.php" class="logout">Cerrar sesión</a>
    </div>
</header>



    <main>
        <h2>Hola, bienvenid@ usuario! 👋</h2>
        <p>Gracias por participar en la encuesta de evaluación docente de nuestra universidad. Tu opinión es muy importante y nos ayuda a mejorar la calidad educativa.</p>

        <h3>Instrucciones importantes📝:</h3>
        <ul>
            <li>Responde cada pregunta con sinceridad y objetividad.</li>
            <br>
            <li>Toda la información es confidencial y anónima.</li>
            <br>
            <li>Evita dejar preguntas sin contestar.</li>
            <br>
            <li>Al finalizar, asegúrate de enviar tus respuestas.</li>
        </ul>

        <button class="btn-avanzar" onclick="window.location.href='encuesta.php'">Comenzar la encuesta</button>
    </main>

    <footer>
        Universidad Tecnologíca de la zona metropolítana de Guadalajara © 2025 - Todos los derechos reservados
    </footer>

</body>
</html>
