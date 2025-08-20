<?php
require_once 'conexion3.php';
$action = $_POST['action'] ?? '';

if ($action === 'add') {
  $text = trim($_POST['question_text'] ?? '');
  if ($text==='') die('Texto requerido');
  $sql = "INSERT INTO CvPregunta (pregunta, activo, prioridad)
          VALUES (?, 1, COALESCE((SELECT MAX(prioridad)+1 FROM CvPregunta),1))";
  $ok = sqlsrv_query($conexion_encuesta, $sql, [$text]);
}
elseif ($action === 'edit') {
  $id   = (int)($_POST['question_id'] ?? 0);
  $text = trim($_POST['question_text'] ?? '');
  $sql  = "UPDATE CvPregunta SET pregunta=? WHERE cvidPregunta=?";
  $ok   = sqlsrv_query($conexion_encuesta, $sql, [$text, $id]);
}
elseif ($action === 'deactivate' || $action === 'activate') {
  $id  = (int)($_POST['question_id'] ?? 0);
  $val = ($action==='activate') ? 1 : 0;
  $sql = "UPDATE CvPregunta SET activo=? WHERE cvidPregunta=?";
  $ok  = sqlsrv_query($conexion_encuesta, $sql, [$val, $id]);
}
header('Location: modificar_encuesta.php');
