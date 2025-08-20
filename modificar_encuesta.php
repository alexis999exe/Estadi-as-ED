<?php
require_once 'conexion3.php'; // $conexion_encuesta

// --- PREGUNTAS ---
$questions = [];
$sqlQ = "SELECT cvidPregunta, pregunta, activo
         FROM CvPregunta
         ORDER BY prioridad, cvidPregunta";
$stmtQ = sqlsrv_query($conexion_encuesta, $sqlQ);
if ($stmtQ === false) { die("Error cargando preguntas: " . print_r(sqlsrv_errors(), true)); }
while ($row = sqlsrv_fetch_array($stmtQ, SQLSRV_FETCH_ASSOC)) {
  $questions[] = [
    'id'     => (int)$row['cvidPregunta'],
    'text'   => $row['pregunta'],
    'active' => (int)$row['activo'] === 1
  ];
}

// --- RESPUESTAS (unidas a pregunta con ponderación) ---
$answers = [];
$sqlA = "SELECT tr.cvidTipoRespuesta,
                tr.descripcionRespuesta,
                tr.activo AS activoTipo,
                ptr.cvidPregunta,
                ptr.ponderacion,
                ptr.activo AS activoVinculo
         FROM CvPregTipResp ptr
         INNER JOIN CvTipoRespuesta tr ON tr.cvidTipoRespuesta = ptr.cvidTipoRespuesta
         ORDER BY ptr.cvidPregunta, tr.cvidTipoRespuesta";
$stmtA = sqlsrv_query($conexion_encuesta, $sqlA);
if ($stmtA === false) { die("Error cargando respuestas: " . print_r(sqlsrv_errors(), true)); }
while ($row = sqlsrv_fetch_array($stmtA, SQLSRV_FETCH_ASSOC)) {
  $answers[] = [
    'id'          => (int)$row['cvidTipoRespuesta'],
    'text'        => $row['descripcionRespuesta'],
    'ponderacion' => (int)$row['ponderacion'],
    'question_id' => (int)$row['cvidPregunta'],
    'active'      => ((int)$row['activoTipo'] === 1) && ((int)$row['activoVinculo'] === 1)
  ];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Modificar Encuesta</title>
  <link rel="stylesheet" href="css/estilos-me.css">
  <style>
  .top-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 8px;
    margin: 12px 0 4px;
  }
  .btn-regresar {
    display: inline-block;
    padding: 10px 16px;
    border-radius: 10px;
    background: linear-gradient(135deg, #0066cc, #26a0f5);
    color: #fff;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 6px 14px rgba(0,0,0,0.12);
    transition: transform .15s ease, box-shadow .15s ease, opacity .15s ease;
  }
  .btn-regresar:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 18px rgba(0,0,0,0.14);
    opacity: .95;
  }
  .btn-regresar:active {
    transform: translateY(0);
    box-shadow: 0 4px 10px rgba(0,0,0,0.12);
  }
</style>

</head>
<body>
<header>
  <div class="contenedor-header">
    <img src="imagenes/LogoUTZMG.png" class="logo" alt="Logo UTZMG">
    <h1>Modificar Encuesta</h1>
  </div>
</header>
<div class="top-actions">
  <a href="admin.php" class="btn-regresar">⬅ Regresar </a>
</div>


<div class="contenedor">
  <h2>Administrar Preguntas</h2>
  <div class="section-header">
    <div class="button-group">
      <button class="btn btn-primary" onclick="openModal('addQuestion')">Agregar Pregunta</button>
    </div>
  </div>

  <div class="table-container">
    <table>
      <thead>
        <tr><th>ID</th><th>Pregunta</th><th>Estado</th><th>Acciones</th></tr>
      </thead>
      <tbody>
      <?php if ($questions): foreach ($questions as $q): ?>
        <tr>
          <td><?= htmlspecialchars($q['id']) ?></td>
          <td><?= htmlspecialchars($q['text']) ?></td>
          <td><span class="<?= $q['active']?'status-active':'status-inactive' ?>"><?= $q['active']?'Activa':'Inactiva' ?></span></td>
          <td>
            <button class="btn btn-secondary"
              onclick='openModal("editQuestion", <?= json_encode($q, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP) ?>)'>Editar</button>

            <?php if ($q['active']): ?>
              <form action="procesar_pregunta.php" method="POST" style="display:inline">
                <input type="hidden" name="action" value="deactivate">
                <input type="hidden" name="question_id" value="<?= (int)$q['id'] ?>">
                <button class="btn btn-danger" type="submit">Desactivar</button>
              </form>
            <?php else: ?>
              <form action="procesar_pregunta.php" method="POST" style="display:inline">
                <input type="hidden" name="action" value="activate">
                <input type="hidden" name="question_id" value="<?= (int)$q['id'] ?>">
                <button class="btn btn-primary" type="submit">Activar</button>
              </form>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; else: ?>
        <tr><td colspan="4">No hay preguntas registradas.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>

  <h2>Administrar Respuestas</h2>
  <div class="section-header">
    <div class="button-group">
      <button class="btn btn-primary" onclick="openModal('addAnswer')">Agregar Respuesta</button>
    </div>
  </div>

  <div class="table-container">
    <table>
      <thead>
        <tr><th>ID</th><th>Respuesta</th><th>Ponderación</th><th>Pregunta</th><th>Estado</th><th>Acciones</th></tr>
      </thead>
      <tbody>
      <?php if ($answers): foreach ($answers as $a): ?>
        <tr>
          <td><?= htmlspecialchars($a['id']) ?></td>
          <td><?= htmlspecialchars($a['text']) ?></td>
          <td><?= htmlspecialchars($a['ponderacion']) ?></td>
          <td>
            <?php
              $q = array_values(array_filter($questions, fn($x)=>$x['id']===$a['question_id']));
              echo $q ? htmlspecialchars($q[0]['text']) : 'N/A';
            ?>
          </td>
          <td><span class="<?= $a['active']?'status-active':'status-inactive' ?>"><?= $a['active']?'Activa':'Inactiva' ?></span></td>
          <td>
            <button class="btn btn-secondary"
              onclick='openModal("editAnswer", <?= json_encode($a, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP) ?>)'>Editar</button>

            <?php if ($a['active']): ?>
              <form action="procesar_respuesta.php" method="POST" style="display:inline">
                <input type="hidden" name="action" value="deactivate">
                <input type="hidden" name="answer_id" value="<?= (int)$a['id'] ?>">
                <input type="hidden" name="question_id" value="<?= (int)$a['question_id'] ?>">
                <button class="btn btn-danger" type="submit">Desactivar</button>
              </form>
            <?php else: ?>
              <form action="procesar_respuesta.php" method="POST" style="display:inline">
                <input type="hidden" name="action" value="activate">
                <input type="hidden" name="answer_id" value="<?= (int)$a['id'] ?>">
                <input type="hidden" name="question_id" value="<?= (int)$a['question_id'] ?>">
                <button class="btn btn-primary" type="submit">Activar</button>
              </form>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; else: ?>
        <tr><td colspan="6">No hay respuestas registradas.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modales SIN secciones -->
<div id="addQuestionModal" class="modal">
  <div class="modal-content">
    <span class="close-button" onclick="closeModal('addQuestionModal')">&times;</span>
    <h3>Agregar Nueva Pregunta</h3>
    <form action="procesar_pregunta.php" method="POST">
      <input type="hidden" name="action" value="add">
      <label for="newQuestionText">Texto de la pregunta:</label>
      <textarea id="newQuestionText" name="question_text" required></textarea>
      <div class="modal-buttons">
        <button type="submit" class="btn btn-primary">Guardar Pregunta</button>
        <button type="button" class="btn btn-secondary" onclick="closeModal('addQuestionModal')">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<div id="editQuestionModal" class="modal">
  <div class="modal-content">
    <span class="close-button" onclick="closeModal('editQuestionModal')">&times;</span>
    <h3>Editar Pregunta</h3>
    <form action="procesar_pregunta.php" method="POST">
      <input type="hidden" name="action" value="edit">
      <input type="hidden" id="editQuestionId" name="question_id">
      <label for="editQuestionText">Texto de la pregunta:</label>
      <textarea id="editQuestionText" name="question_text" required></textarea>
      <div class="modal-buttons">
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <button type="button" class="btn btn-secondary" onclick="closeModal('editQuestionModal')">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<div id="addAnswerModal" class="modal">
  <div class="modal-content">
    <span class="close-button" onclick="closeModal('addAnswerModal')">&times;</span>
    <h3>Agregar Nueva Respuesta</h3>
    <form action="procesar_respuesta.php" method="POST">
      <input type="hidden" name="action" value="add">
      <label for="newAnswerText">Texto de la respuesta:</label>
      <input type="text" id="newAnswerText" name="answer_text" required>

      <label for="newAnswerPonderacion">Ponderación (7–10 o 0 para Sí/No):</label>
      <select id="newAnswerPonderacion" name="answer_ponderacion" required>
        <option value="10">10</option><option value="9">9</option>
        <option value="8">8</option><option value="7">7</option>
        <option value="0">0 (Sí/No)</option>
      </select>

      <label for="newAnswerQuestionId">Pregunta Correspondiente:</label>
      <select id="newAnswerQuestionId" name="question_id" required>
        <?php foreach ($questions as $q): ?>
          <option value="<?= (int)$q['id'] ?>"><?= htmlspecialchars(mb_strimwidth($q['text'],0,80,'...')) ?></option>
        <?php endforeach; ?>
      </select>

      <div class="modal-buttons">
        <button type="submit" class="btn btn-primary">Guardar Respuesta</button>
        <button type="button" class="btn btn-secondary" onclick="closeModal('addAnswerModal')">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<div id="editAnswerModal" class="modal">
  <div class="modal-content">
    <span class="close-button" onclick="closeModal('editAnswerModal')">&times;</span>
    <h3>Editar Respuesta</h3>
    <form action="procesar_respuesta.php" method="POST">
      <input type="hidden" name="action" value="edit">
      <input type="hidden" id="editAnswerId" name="answer_id">
      <label for="editAnswerText">Texto de la respuesta:</label>
      <input type="text" id="editAnswerText" name="answer_text" required>

      <label for="editAnswerPonderacion">Ponderación:</label>
      <select id="editAnswerPonderacion" name="answer_ponderacion" required>
        <option value="10">10</option><option value="9">9</option>
        <option value="8">8</option><option value="7">7</option>
        <option value="0">0</option>
      </select>

      <label for="editAnswerQuestionId">Pregunta Correspondiente:</label>
      <select id="editAnswerQuestionId" name="question_id" required>
        <?php foreach ($questions as $q): ?>
          <option value="<?= (int)$q['id'] ?>"><?= htmlspecialchars(mb_strimwidth($q['text'],0,80,'...')) ?></option>
        <?php endforeach; ?>
      </select>

      <div class="modal-buttons">
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <button type="button" class="btn btn-secondary" onclick="closeModal('editAnswerModal')">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<script>
function openModal(type, data=null){
  document.querySelectorAll('.modal').forEach(m=>m.style.display='none');
  let m=null;
  if(type==='addQuestion'){ m=document.getElementById('addQuestionModal'); document.getElementById('newQuestionText').value=''; }
  if(type==='editQuestion'){
    m=document.getElementById('editQuestionModal');
    document.getElementById('editQuestionId').value = data.id;
    document.getElementById('editQuestionText').value = data.text;
  }
  if(type==='addAnswer'){
    m=document.getElementById('addAnswerModal');
    document.getElementById('newAnswerText').value='';
    document.getElementById('newAnswerPonderacion').value='10';
  }
  if(type==='editAnswer'){
    m=document.getElementById('editAnswerModal');
    document.getElementById('editAnswerId').value = data.id;
    document.getElementById('editAnswerText').value = data.text;
    document.getElementById('editAnswerPonderacion').value = data.ponderacion;
    document.getElementById('editAnswerQuestionId').value = data.question_id;
  }
  if(m) m.style.display='flex';
}
function closeModal(id){ document.getElementById(id).style.display='none'; }
window.onclick = (e)=>{ document.querySelectorAll('.modal').forEach(m=>{ if(e.target===m) m.style.display='none'; }); };

</script>
</body>
</html>

