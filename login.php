<?php
// Aquí podrías procesar el login más adelante con PHP y base de datos
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Evaluación Docente</title>
    <link rel="stylesheet" href="css/estilos-l.css"> <!-- Estilos exclusivos para login -->
</head>
<body class="login-body">

    <div class="login-container">
        <img src="imagenes/LogoUTZMG.png" alt="Logo de la Universidad" class="login-logo">

        <h2 class="login-title">Iniciar Sesión</h2>

        <form action="index.php" method="post" class="login-form">
            <label for="matricula">Matrícula:</label>
            <input type="text" id="matricula" name="matricula" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <button type="submit" class="btn-login">Ingresar</button>
        </form>
    </div>

</body>
</html>

