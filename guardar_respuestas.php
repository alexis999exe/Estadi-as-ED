<?php
$profesor = $_POST["profesor"];
$comentario = $_POST["comentario"] ?? "";

// Tabla de ponderaciones por respuesta seleccionada (solo preguntas 1 a 10)
$ponderacionPorRespuesta = [
    1 => 7,
    2 => 8,
    3 => 9,
    4 => 10
];

$total = 0;
$preguntasValidas = 0;

// Preguntas 1 a 10 tienen opciones ponderadas (pregunta 11 es Sí/No)
for ($i = 1; $i <= 10; $i++) {
    if (isset($_POST["pregunta$i"])) {
        $valor = (int) $_POST["pregunta$i"];
        if (isset($ponderacionPorRespuesta[$valor])) {
            $total += $ponderacionPorRespuesta[$valor];
            $preguntasValidas++;
        }
    }
}

$promedio = $preguntasValidas > 0 ? $total / $preguntasValidas : 0;

// Mostrar resultados (o guardar en BD)
echo "<h2>Evaluación enviada</h2>";
echo "<p>Profesor: $profesor</p>";
echo "<p>Comentario: $comentario</p>";
echo "<p>Promedio ponderado: " . number_format($promedio, 2) . "</p>";

// Aquí podrías guardar en base de datos con PDO/MySQLi
?>
