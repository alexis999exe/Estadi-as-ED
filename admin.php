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
    <link rel="stylesheet" href="css/estilos-adm.css">
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
            <li><a href="#" onclick="openCreateSurveyModal(); return false;">✨ Crear nueva encuesta</a></li>
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
            <input type="hidden" name="action" id="modalAction" value="">
            <div id="activateFields">
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

<div id="createSurveyModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('createSurveyModal')">&times;</span>
        <h3>Crear Nueva Encuesta</h3>
        <form id="formCreateSurvey" action="procesar_creacion_encuesta.php" method="POST">
            <div class="modal-form-group">
                <label for="surveyTitle">Título de la Encuesta:</label>
                <input type="text" id="surveyTitle" name="titulo" required placeholder="Ej: Encuesta de Satisfacción Docente 2025M">
            </div>

            <div class="modal-form-group">
                <label for="surveyDescription">Descripción:</label>
                <textarea id="surveyDescription" name="descripcion" rows="4" placeholder="Breve descripción de la encuesta."></textarea>
            </div>

            <div class="modal-form-group">
                <label for="createSurveyCiclo">Ciclo al que aplica:</label>
                <select id="createSurveyCiclo" name="ciclo" required>
                    <option value="">Selecciona un ciclo</option>
                    <?php foreach ($ciclos_disponibles as $ciclo): ?>
                        <option value="<?php echo htmlspecialchars($ciclo); ?>"><?php echo htmlspecialchars($ciclo); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="modal-buttons">
                <button type="submit" class="btn btn-modal-confirm">Guardar Encuesta</button>
                <button type="button" class="btn btn-modal-cancel" onclick="closeModal('createSurveyModal')">Cancelar</button>
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

    // Nueva variable para la modal de creación de encuestas
    const createSurveyModal = document.getElementById('createSurveyModal');

    // Estado inicial de la encuesta, cargado desde PHP
    let encuestaActiva = <?php echo json_encode($encuestaActiva); ?>;

    // Función para abrir la modal de Activar/Desactivar
    function openModal(actionType) {
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

    // NUEVA FUNCIÓN: para abrir la modal de Crear Nueva Encuesta
    function openCreateSurveyModal() {
        createSurveyModal.style.display = 'flex'; // Muestra la nueva modal
        // Puedes resetear el formulario aquí si es necesario
        document.getElementById('formCreateSurvey').reset();
    }


    // Función para cerrar cualquier modal
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    // Event listener para el botón principal de la encuesta (Activar/Desactivar)
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
        // Añadir el listener para la nueva modal
        if (event.target == createSurveyModal) {
            closeModal('createSurveyModal');
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