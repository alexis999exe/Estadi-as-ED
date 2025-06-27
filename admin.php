<?php
session_start();
// Datos de sesión, si el usuario no está logueado, redirigir o establecer un valor por defecto.
$usuario = $_SESSION['usuario'] ?? 'Administrador';

// Simulación de ciclos precargados desde la BD
// En un entorno real, esto vendría de una consulta a tu base de datos de SQL Server.
$ciclos_disponibles = [
    '2025M',
    '2025S',
    '2026E',
    '2026M',
    '2026S',
];

// Aquí podrías cargar el estado actual de la encuesta (activa/inactiva) desde la BD.
// Por ahora, lo simulamos.
$encuestaActiva = false; // Asumimos que inicialmente no está activa hasta que se configure.

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="css/estilos-ad.css">
    <style>
        /* Estilos generales del body y layout para el footer fijo */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Header existente */
        header {
            background-color: #7e1f1f;
            color: white;
            padding: 15px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap; /* Permite que el contenido se ajuste */
        }

        .contenedor-header {
            display: flex;
            align-items: center;
            padding-left: 20px;
        }

        .contenedor-header .logo {
            height: 80px;
            margin-right: 15px;
        }

        .contenedor-header h1 {
            margin: 0;
            font-size: 2.2em;
        }

        .usuario-header {
            display: flex;
            align-items: center;
            padding-right: 20px;
        }

        .usuario-header span {
            margin-right: 15px;
            font-weight: bold;
            font-size: 1.1em;
        }

        .usuario-header .logout {
            background-color: #f44336;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .usuario-header .logout:hover {
            background-color: #da190b;
        }

        /* Contenido principal y menú lateral */
        .admin-container {
            display: flex;
            flex-grow: 1; /* Permite que este contenedor ocupe el espacio disponible */
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            overflow: hidden; /* Para que los bordes redondeados se apliquen bien */
        }

        .contenido-principal {
            flex-grow: 1;
            padding: 40px;
            box-sizing: border-box;
        }

        .contenido-principal h2 {
            color: #7e1f1f;
            text-align: center;
            margin-bottom: 30px;
        }

        .contenido-principal p {
            text-align: center;
            margin-bottom: 40px;
            font-size: 1.1em;
            color: #555;
        }

        #control-encuesta {
            text-align: center;
            margin-top: 50px;
        }

        .btn-encuesta {
            background-color: #4CAF50; /* Verde por defecto para "Activar" */
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-size: 1.3em;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .btn-encuesta.active { /* Clase para cuando la encuesta esté activa (botón "Desactivar") */
            background-color: #f44336; /* Rojo */
        }

        .btn-encuesta:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }

        .menu-lateral {
            width: 280px;
            background-color: #f8f8f8;
            padding: 40px 20px;
            border-left: 1px solid #eee;
            box-sizing: border-box;
        }

        .menu-lateral h3 {
            color: #7e1f1f;
            margin-top: 0;
            margin-bottom: 30px;
            text-align: center;
            font-size: 1.5em;
        }

        .menu-lateral ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-lateral ul li {
            margin-bottom: 15px;
        }

        .menu-lateral ul li a {
            display: block;
            padding: 12px 15px;
            background-color: #ececec;
            color: #333;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-size: 1.1em;
        }

        .menu-lateral ul li a:hover {
            background-color: #7e1f1f;
            color: white;
        }

        /* --- Estilos para la Modal (Ventana Emergente) --- */
        .modal {
            display: none; /* Oculto por defecto */
            position: fixed; /* Posición fija para que cubra toda la pantalla */
            z-index: 1000; /* Asegura que esté por encima de otros elementos */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; /* Habilita scroll si el contenido es demasiado grande */
            background-color: rgba(0,0,0,0.4); /* Fondo semi-transparente oscuro */
            justify-content: center; /* Centra el contenido de la modal horizontalmente */
            align-items: center; /* Centra el contenido de la modal verticalmente */
            animation-name: fadeIn;
            animation-duration: 0.3s;
        }

        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }

        .modal-content {
            background-color: #fefefe;
            padding: 30px;
            border: 1px solid #888;
            width: 90%; /* Ancho de la modal */
            max-width: 500px; /* Ancho máximo para evitar que sea demasiado grande */
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            position: relative;
            animation-name: animatetop;
            animation-duration: 0.4s;
        }

        /* Animación para que la modal aparezca desde arriba */
        @keyframes animatetop {
            from {top: -300px; opacity: 0}
            to {top: 0; opacity: 1}
        }

        .close-button {
            color: #aaa;
            font-size: 30px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 20px;
            cursor: pointer;
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
        }

        .modal-content h3 {
            color: #7e1f1f;
            text-align: center;
            margin-bottom: 25px;
            font-size: 1.8em;
        }

        .modal-form-group {
            margin-bottom: 20px;
        }

        .modal-form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
            font-size: 1.1em;
        }

        .modal-form-group select,
        .modal-form-group input[type="datetime-local"] {
            width: calc(100% - 22px); /* Ancho completo menos padding y borde */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            background-color: #fefefe; /* Fondo blanco */
        }

        .modal-buttons {
            text-align: right;
            margin-top: 30px;
        }

        .modal-buttons .btn {
            margin-left: 10px;
            padding: 10px 20px; /* Ajuste para botones dentro de la modal */
            font-size: 1.1em;
        }

        /* Estilos específicos para el botón de la modal */
        .btn-modal-confirm {
            background-color: #4CAF50; /* Verde */
            color: white;
        }
        .btn-modal-confirm:hover {
            background-color: #45a049;
        }

        .btn-modal-cancel {
            background-color: #f44336; /* Rojo */
            color: white;
        }
        .btn-modal-cancel:hover {
            background-color: #da190b;
        }

        /* Footer */
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

        @media (max-width: 768px) {
            header {
                flex-direction: column;
                padding-top: 10px;
                padding-bottom: 10px;
            }
            .contenedor-header, .usuario-header {
                padding: 0 15px;
                width: 100%;
                justify-content: center; /* Centra el logo y el título en móvil */
                margin-bottom: 10px;
            }
            .contenedor-header h1 {
                font-size: 1.8em;
                text-align: center;
            }
            .usuario-header span, .usuario-header .logout {
                font-size: 1em;
            }
            .admin-container {
                flex-direction: column;
                margin: 15px;
                box-shadow: none; /* Quita la sombra en móvil para menos 'peso' */
            }
            .contenido-principal {
                padding: 20px;
            }
            .menu-lateral {
                width: 100%;
                border-left: none;
                border-top: 1px solid #eee;
                padding: 20px;
            }
            .menu-lateral ul li a {
                font-size: 1em;
                padding: 10px;
            }
            .btn-encuesta {
                padding: 12px 25px;
                font-size: 1.1em;
            }
            .modal-content {
                width: 95%; /* Hace la modal casi de ancho completo en móviles */
                padding: 15px;
            }
            .modal-form-group select,
            .modal-form-group input[type="datetime-local"] {
                 width: calc(100% - 20px); /* Ajuste del ancho para inputs en móviles */
            }
        }

        @media (max-width: 480px) {
            .contenedor-header .logo {
                height: 60px;
                margin-right: 10px;
            }
            .contenedor-header h1 {
                font-size: 1.6em;
            }
            .contenido-principal h2 {
                font-size: 1.5em;
            }
            .contenido-principal p {
                font-size: 0.95em;
            }
        }
    </style>
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
            <button id="toggleEncuesta" class="btn-encuesta <?php echo $encuestaActiva ? 'active' : ''; ?>">
                <?php echo $encuestaActiva ? 'Desactivar encuesta' : 'Activar encuesta'; ?>
            </button>
        </div>
    </main>

    <aside class="menu-lateral">
        <h3>Opciones</h3>
        <ul>
            <li><a href="modificar_encuesta.php">✏️ Modificar encuesta</a></li>
            <li><a href="reportes.php">📊 Generar reportes</a></li>
            <li><a href="progreso.php">✅ Progreso</a></li>
            <li><a href="alumn_sc.php">❌ Alumnos sin contestar</a></li>
        </ul>
    </aside>
</div>

<div id="configEncuestaModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('configEncuestaModal')">&times;</span>
        <h3>Configurar Activación de Encuesta</h3>
        <form id="formConfigEncuesta" action="procesar_activacion_encuesta.php" method="POST">
            <input type="hidden" name="action" id="modalAction" value=""> <div id="activateFields">
                <div class="modal-form-group">
                    <label for="ciclo">Ciclo de la Encuesta:</label>
                    <select id="ciclo" name="ciclo" required>
                        <option value="">Selecciona un ciclo</option>
                        <?php foreach ($ciclos_disponibles as $ciclo): ?>
                            <option value="<?php echo htmlspecialchars($ciclo); ?>"><?php echo htmlspecialchars($ciclo); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="modal-form-group">
                    <label for="fechaCierre">Fecha y Hora de Cierre:</label>
                    <input type="datetime-local" id="fechaCierre" name="fecha_cierre" required>
                </div>
            </div>

            <p id="deactivateMessage" style="display: none; text-align: center; font-size: 1.1em; color: #555;">
                ¿Estás seguro de que deseas **desactivar** la encuesta actual?
            </p>

            <div class="modal-buttons">
                <button type="submit" class="btn btn-modal-confirm" id="modalSubmitButton">Confirmar</button>
                <button type="button" class="btn btn-modal-cancel" onclick="closeModal('configEncuestaModal')">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<footer>
    Universidad Tecnológica de la Zona Metropolitana de Guadalajara © 2025
</footer>

<script>
    const btnEncuesta = document.getElementById('toggleEncuesta');
    const configEncuestaModal = document.getElementById('configEncuestaModal');
    const modalAction = document.getElementById('modalAction');
    const activateFields = document.getElementById('activateFields');
    const deactivateMessage = document.getElementById('deactivateMessage');
    const modalSubmitButton = document.getElementById('modalSubmitButton');

    // Estado inicial de la encuesta, cargado desde PHP
    let encuestaActiva = <?php echo json_encode($encuestaActiva); ?>;

    // Función para abrir la modal
    function openModal(actionType) {
        // Limpiar estilos previos del botón (no necesario aquí, pero buena práctica si hubiera más interacción)
        // btnEncuesta.classList.remove('active'); // Esto se maneja en setInitialButtonState

        if (actionType === 'activate') {
            modalAction.value = 'activate';
            configEncuestaModal.querySelector('h3').textContent = 'Configurar Activación de Encuesta';
            activateFields.style.display = 'block'; // Mostrar campos de configuración
            deactivateMessage.style.display = 'none'; // Ocultar mensaje de desactivación
            modalSubmitButton.textContent = 'Activar Encuesta';
            modalSubmitButton.classList.remove('btn-modal-cancel');
            modalSubmitButton.classList.add('btn-modal-confirm');
            // Opcional: precargar la fecha de cierre con una fecha futura por defecto
            const now = new Date();
            now.setDate(now.getDate() + 7); // 7 días en el futuro desde la fecha actual
            // Formatear a 'YYYY-MM-DDTHH:MM' para el input datetime-local
            const year = now.getFullYear();
            const month = (now.getMonth() + 1).toString().padStart(2, '0');
            const day = now.getDate().toString().padStart(2, '0');
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            document.getElementById('fechaCierre').value = `${year}-${month}-${day}T${hours}:${minutes}`;

        } else if (actionType === 'deactivate') {
            modalAction.value = 'deactivate';
            configEncuestaModal.querySelector('h3').textContent = 'Desactivar Encuesta';
            activateFields.style.display = 'none'; // Ocultar campos de configuración
            deactivateMessage.style.display = 'block'; // Mostrar mensaje de desactivación
            modalSubmitButton.textContent = 'Sí, Desactivar';
            modalSubmitButton.classList.remove('btn-modal-confirm');
            modalSubmitButton.classList.add('btn-modal-cancel');
        }
        configEncuestaModal.style.display = 'flex'; // Usar flex para centrar
    }

    // Función para cerrar la modal
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    // Event listener para el botón principal de la encuesta
    btnEncuesta.addEventListener('click', () => {
        if (!encuestaActiva) {
            openModal('activate'); // Si no está activa, abrir modal para activar
        } else {
            openModal('deactivate'); // Si está activa, abrir modal para desactivar
        }
    });

    // Cerrar la modal si se hace clic fuera del contenido de la modal
    window.onclick = function(event) {
        if (event.target == configEncuestaModal) {
            closeModal('configEncuestaModal');
        }
    }

    // Establecer el estado inicial del botón en la carga de la página
    function setInitialButtonState() {
        if (encuestaActiva) {
            btnEncuesta.textContent = "Desactivar encuesta";
            btnEncuesta.classList.add('active');
        } else {
            btnEncuesta.textContent = "Activar encuesta";
            btnEncuesta.classList.remove('active');
        }
    }
    document.addEventListener('DOMContentLoaded', setInitialButtonState);

</script>

</body>
</html>