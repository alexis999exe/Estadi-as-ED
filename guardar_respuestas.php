<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gracias por tu participación</title>
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
    <h2>¡Gracias por tu participación! 🙌</h2>
    <p>Tu opinión es muy valiosa para nosotros y contribuirá significativamente a mejorar la calidad educativa en nuestra universidad.</p>

    <p>Te agradecemos el tiempo que dedicaste para responder la encuesta.</p>

    <p>¡Hasta pronto! 👋</p>

    <button class="btn-avanzar" onclick="window.location.href='login.php'">Volver al inicio</button>
</main>

<footer>
    Universidad Tecnologíca de la zona metropolítana de Guadalajara © 2025 - Todos los derechos reservados
</footer>

</body>
</html>
