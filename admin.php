<?php
session_start();
$usuario = $_SESSION['usuario'] ?? 'Administrador';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="css/estilos-ad.css">
</head>
<body>

<header>
    <div class="contenedor-header">
        <img src="imagenes/LogoUTZMG.png" alt="Logo de la Universidad" class="logo">
        <h1>Panel de Administración</h1>
    </div>
    <div class="usuario-header">
        <span><?php echo htmlspecialchars($usuario); ?></span>
        <a href="logout.php" class="logout">Cerrar sesión</a>
    </div>
</header>


    <div class="admin-container">
        <main class="contenido-principal">
            <h2>Bienvenido, <?php echo htmlspecialchars($usuario); ?> 👋</h2>
            <p>Utiliza el panel de la derecha para acceder a las herramientas administrativas.</p>
            <div id="control-encuesta">
            <button id="toggleEncuesta" class="btn-encuesta">Activar encuesta</button>
        </main>

        <aside class="menu-lateral">
            <h3>Opciones</h3>
            <ul>
                <li><a href="modificar_encuesta.php">✏️ Modificar encuesta</a></li>
                <li><a href="gestionar-prof.php">👨‍🏫 Gestionar profesores</a></li>
                <li><a href="reportes.php">📊 Generar reportes</a></li>
                <li><a href="progreso.php">✅ Progreso</a></li>
                <li><a href="alumn_sc.php">❌ Alumnos sin contestar</a></li>
            </ul>
        </aside>
    </div>
    <script>
    const btnEncuesta = document.getElementById('toggleEncuesta');
    let encuestaActiva = false;

    btnEncuesta.addEventListener('click', () => {
        if (!encuestaActiva) {
            const confirmar = confirm("¿Estás seguro de que deseas ACTIVAR la encuesta?");
            if (confirmar) {
                encuestaActiva = true;
                btnEncuesta.textContent = "Desactivar encuesta";
                alert("La encuesta ha sido activada.");
            }
        } else {
            const confirmar = confirm("¿Estás seguro de que deseas DESACTIVAR la encuesta?");
            if (confirmar) {
                encuestaActiva = false;
                btnEncuesta.textContent = "Activar encuesta";
                alert("La encuesta ha sido desactivada.");
            }
        }
    });
</script>

</body>
</html>
