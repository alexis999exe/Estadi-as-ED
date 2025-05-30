$ponderacionPorRespuesta = [
    1 => 7,
    2 => 8,
    3 => 9,
    4 => 10
];

$total = 0;
$numeroDePreguntas = 0;

for ($i = 1; $i <= 11; $i++) {
    if (isset($_POST["pregunta$i"])) {
        $valor = (int) $_POST["pregunta$i"]; // 1, 2, 3, 4
        if (isset($ponderacionPorRespuesta[$valor])) {
            $total += $ponderacionPorRespuesta[$valor];
            $numeroDePreguntas++;
        }
    }
}

$promedio = $numeroDePreguntas > 0 ? $total / $numeroDePreguntas : 0;

// Puedes guardar el promedio con el profesor y comentario
$profesor = $_POST["profesor"];
$comentario = $_POST["comentario"] ?? "";

// Aquí va el guardado a tu base de datos
