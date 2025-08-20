<?php
require_once 'conexion3.php';
$action = $_POST['action'] ?? '';

if ($action === 'add') {
  $text = trim($_POST['answer_text'] ?? '');
  $pond = (int)($_POST['answer_ponderacion'] ?? 0);
  $qId  = (int)($_POST['question_id'] ?? 0);

  // 1) Crea tipo de respuesta (catálogo)
  $sql1 = "INSERT INTO CvTipoRespuesta (descripcionRespuesta, activo) VALUES (?, 1)";
  $ok1  = sqlsrv_query($conexion_encuesta, $sql1, [$text]);
  if ($ok1 === false) die(print_r(sqlsrv_errors(), true));

  // ID creado
  $stmtId = sqlsrv_query($conexion_encuesta, "SELECT SCOPE_IDENTITY() AS id");
  $rowId  = sqlsrv_fetch_array($stmtId, SQLSRV_FETCH_ASSOC);
  $tipoId = (int)$rowId['id'];

  // 2) Vincula a la pregunta con ponderación
  $sql2 = "INSERT INTO CvPregTipResp (cvidPregunta, cvidTipoRespuesta, activo, ponderacion)
           VALUES (?, ?, 1, ?)";
  $ok2  = sqlsrv_query($conexion_encuesta, $sql2, [$qId, $tipoId, $pond]);
}
elseif ($action === 'edit') {
  $answerId = (int)($_POST['answer_id'] ?? 0); // cvidTipoRespuesta
  $text     = trim($_POST['answer_text'] ?? '');
  $pond     = (int)($_POST['answer_ponderacion'] ?? 0);
  $qId      = (int)($_POST['question_id'] ?? 0);

  // Edita texto del catálogo
  $sql1 = "UPDATE CvTipoRespuesta SET descripcionRespuesta=? WHERE cvidTipoRespuesta=?";
  $ok1  = sqlsrv_query($conexion_encuesta, $sql1, [$text, $answerId]);

  // Edita ponderación del vínculo
  $sql2 = "UPDATE CvPregTipResp SET ponderacion=? WHERE cvidPregunta=? AND cvidTipoRespuesta=?";
  $ok2  = sqlsrv_query($conexion_encuesta, $sql2, [$pond, $qId, $answerId]);
}
elseif ($action === 'deactivate' || $action === 'activate') {
  $answerId = (int)($_POST['answer_id'] ?? 0);
  $qId      = (int)($_POST['question_id'] ?? 0);
  $val      = ($action==='activate') ? 1 : 0;

  // Des/activar vínculo (para esa pregunta)
  $sql = "UPDATE CvPregTipResp SET activo=? WHERE cvidPregunta=? AND cvidTipoRespuesta=?";
  $ok  = sqlsrv_query($conexion_encuesta, $sql, [$val, $qId, $answerId]);

  // (Opcional) también des/activar el catálogo base:
  // $sqlTipo = "UPDATE CvTipoRespuesta SET activo=? WHERE cvidTipoRespuesta=?";
  // $okTipo  = sqlsrv_query($conexion_encuesta, $sqlTipo, [$val, $answerId]);
}
header('Location: modificar_encuesta.php');
