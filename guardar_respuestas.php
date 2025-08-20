<?php
require_once 'conexion3.php'; // BD encuesta (alumno_comentario_h, FK a encuesta.dbo.ciclo?)
require_once 'conexion.php';  
//require_once 'conexion2.php'; 
session_start();

$matricula = $_SESSION['matricula'] ?? null;
$profesor  = $_POST['profesor'] ?? null; // idProfesor (INT)
$fecha     = date("Y-m-d H:i:s");

if (!$matricula) {
    die('❌ No hay matrícula en la sesión.');
}
if ($profesor === null || !ctype_digit((string)$profesor)) {
    die('❌ El <select> de profesor está enviando un valor no numérico. Asegúrate de usar idProfesor como value.');
}

/* 1) Obtener idCiclo ACTIVO desde Horarios.dbo.Ciclo */
$idCiclo = null;

// Primero intentamos por activo=1 (está en Horarios.dbo.Ciclo)
$sqlCicloActivo = "SELECT TOP 1 idCiclo 
                   FROM [Horarios].[dbo].[Ciclo] 
                   WHERE activo = 1
                   ORDER BY fechaInicio DESC";
$stmtCA = sqlsrv_query($conexion, $sqlCicloActivo);
if ($stmtCA === false) {
    die('❌ Error consultando Horarios.dbo.Ciclo (activo): ' . print_r(sqlsrv_errors(), true));
}
$rowCA = sqlsrv_fetch_array($stmtCA, SQLSRV_FETCH_ASSOC);
if ($rowCA && isset($rowCA['idCiclo'])) {
    $idCiclo = (int)$rowCA['idCiclo'];
} else {
    // Fallback: el mayor idCiclo
    $sqlCicloMax = "SELECT TOP 1 idCiclo 
                    FROM [Horarios].[dbo].[Ciclo]
                    ORDER BY idCiclo DESC";
    $stmtCM = sqlsrv_query($conexion, $sqlCicloMax);
    if ($stmtCM === false) {
        die('❌ Error consultando Horarios.dbo.Ciclo (TOP 1): ' . print_r(sqlsrv_errors(), true));
    }
    $rowCM = sqlsrv_fetch_array($stmtCM, SQLSRV_FETCH_ASSOC);
    if ($rowCM && isset($rowCM['idCiclo'])) {
        $idCiclo = (int)$rowCM['idCiclo'];
    } else {
        die('❌ No hay registros en Horarios.dbo.Ciclo.');
    }
}

/* (Opcional pero recomendado)
   Si tu FK en encuesta.dbo.alumno_comentario_h → encuesta.dbo.ciclo(id),
   verifica que ese id exista también allí. Si no existe, fallará el FK.
*/
$existeCicloEncuesta = false;
$checkCiclo = sqlsrv_query(
    $conexion_encuesta,
    "SELECT 1 FROM dbo.ciclo WHERE id = ?",
    array($idCiclo)
);
if ($checkCiclo !== false && sqlsrv_fetch_array($checkCiclo, SQLSRV_FETCH_NUMERIC)) {
    $existeCicloEncuesta = true;
}
if (!$existeCicloEncuesta) {
    die("❌ El idCiclo=$idCiclo existe en Horarios.dbo.Ciclo, pero NO existe en encuesta.dbo.ciclo(id). " .
        "Debes sincronizar el ciclo en la tabla 'encuesta.dbo.ciclo' o ajustar el FK.");
}

/* 2) Traer relación alumno–materia del profesor (valumno_materia) */
// SIN esquema: igual que en la página del formulario
// Ejemplos: AJUSTA el nombre de BD y esquema reales
$sqlAM = "SELECT TOP 1 idAluMat, cve_materia
          FROM valumno_materia
          WHERE matricula = ? AND idProfesor = ?
          ORDER BY idAluMat DESC";
$paramsAM = array($matricula, (int)$profesor);
$stmtAM = sqlsrv_query($conexion, $sqlAM, $paramsAM); // <- usa $conexion


if ($stmtAM === false) {
    die('❌ Error consultando valumno_materia: ' . print_r(sqlsrv_errors(), true));
}
$rel = sqlsrv_fetch_array($stmtAM, SQLSRV_FETCH_ASSOC);
if (!$rel) {
    die('❌ No se encontró relación alumno–materia para esa matrícula y profesor en valumno_materia.');
}
$idAluMat   = $rel['idAluMat'];
$cveMateria = $rel['cve_materia'];

/* 3) Guardar comentario (pregunta 13 → textarea) */
if (isset($_POST['pregunta13']) && trim($_POST['pregunta13']) !== '') {
    $comentario = trim($_POST['pregunta13']);

    $sqlComentario = "INSERT INTO alumno_comentario_h
        (idAluMat, matricula, cve_materia, idProfr, comentario, fecha, idCiclo)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
    $paramsComentario = array(
        $idAluMat,
        $matricula,
        $cveMateria,
        (int)$profesor,
        $comentario,
        $fecha,
        $idCiclo
    );

    $stmtComentario = sqlsrv_query($conexion_encuesta, $sqlComentario, $paramsComentario);
    if ($stmtComentario === false) {
        die('❌ Error al guardar comentario: ' . print_r(sqlsrv_errors(), true));
    }
}
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
        <a href="logout.php" class="logout">Cerrar sesión</a>
    </div>
</header>

<main>
    <h2>¡Gracias por tu participación! 🙌</h2>
    <p>Te agradecemos el tiempo que dedicaste para responder esta evaluación.</p>
    <p>¡Hasta pronto! 👋</p>
    <button class="btn-avanzar" onclick="window.location.href='login.php'">Volver al inicio</button>
</main>

<footer>
    Universidad Tecnológica de la Zona Metropolitana de Guadalajara © 2025 - Todos los derechos reservados
</footer>

</body>
</html>
