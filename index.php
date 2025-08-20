<?php
session_start(); // ¡ESENCIAL! Siempre al inicio para usar sesiones.

// Seguridad: Redirige al login si el usuario no ha iniciado sesión.
if (!isset($_SESSION['matricula'])) { // Puedes usar cualquier variable de sesión clave, como 'matricula'
    header('Location: login.php');
    exit();
}

// Obtiene el nombre del usuario de la sesión.
// ¡Importante!: Ahora usamos 'nombre_usuario' que es como lo guardamos en login.php
// Si por alguna razón no está definido, se usará "Invitado" como valor por defecto.
//$nombre_usuario = $_SESSION['nombre_usuario'] ?? 'Invitado';
$nombre_usuario = $_SESSION['nombre_completo'] ?? 'Invitado';




// Si el usuario es un "Alumno", podemos ajustar el mensaje de bienvenida.
$saludo_bienvenida = "Hola, bienvenid@ " . htmlspecialchars($nombre_usuario) . "! 👋";

// Opcional: Si quieres diferenciar el saludo para tipos de usuario específicos
// if (isset($_SESSION['idtipoUsuario']) && $_SESSION['idtipoUsuario'] == 3) { // Si es un alumno
//     $saludo_bienvenida = "Hola, bienvenid@ " . htmlspecialchars($nombre_usuario) . "! 👋";
// } else {
//     $saludo_bienvenida = "Bienvenido/a " . htmlspecialchars($nombre_usuario) . "! 👋";
// }

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
        <a href="logout.php" class="logout">Cerrar sesión</a>
    </div>
</header>

<main>
    <h2><?php echo $saludo_bienvenida; ?></h2>
    <p>Tu participación es importante, tu opinión ayudará a mejorar los procesos de enseñanza-aprendizaje y calidad académica de nuestra Universidad.</p>

    <h3>Instrucciones importantes📝:</h3>
    <ul>
        <li>Toda la información es confidencial y anónima.</li>
        <br>
        <li>Responde cada pregunta con sinceridad y objetividad.</li>
        <br>
        <li>No podras avanzar si dejas preguntas sin contestar.</li>
        <br>
        <li>Al finalizar, asegúrate de enviar tus respuestas.</li>
        <br>
        <li>Después de 5 minutos de inactividad se cerrará la sesión automaticámente y no se guardara la información registrada.</li>
    </ul>

    <button class="btn-avanzar" onclick="window.location.href='encuesta.php'">Comenzar la encuesta</button>
</main>

<footer>
    Universidad Tecnológica de la Zona Metropolitana de Guadalajara © 2025 - Todos los derechos reservados
</footer>

</body>
</html>