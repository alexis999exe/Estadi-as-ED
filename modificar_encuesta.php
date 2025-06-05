<?php



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Encuesta</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        .contenedor {
            max-width: 1000px;
            margin: 40px auto;
            background: #fff;
            padding: 40px 60px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            box-sizing: border-box;
        }

        h2, h3 {
            text-align: center;
            color: #7e1f1f;
        }

        .pregunta-editable {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .pregunta-editable input[type="text"] {
            flex: 1;
            padding: 10px;
        }

        .pregunta-editable button {
            background-color: #c62828;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-guardar, .btn-agregar {
            background-color: #0073e6;
            color: white;
            padding: 12px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-guardar:hover, .btn-agregar:hover {
            background-color: #005bb5;
        }

        input[type="text"].titulo {
            width: 100%;
            font-size: 18px;
            padding: 10px;
            margin-bottom: 30px;
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
<footer>
    Universidad Tecnológica de la Zona Metropolitana de Guadalajara © 2025
</footer>
</body>
</html>
