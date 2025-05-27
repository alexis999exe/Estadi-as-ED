<!-- gestionar_profesores.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Profesores</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        .contenedor {
            max-width: 1000px;
            margin: 40px auto;
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        .acciones button {
            margin-right: 5px;
            padding: 6px 12px;
            background: #0073e6;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .acciones button.eliminar {
            background: #c62828;
        }
        .btn-agregar {
            margin-top: 10px;
            padding: 10px 20px;
            background: #2e7d32;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="contenedor">
    <h2>Gestionar Profesores</h2>

    <button class="btn-agregar">Agregar Profesor</button>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Departamento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Datos ficticios como ejemplo -->
            <tr>
                <td>1</td>
                <td>María Pérez</td>
                <td>maria@utzmg.edu.mx</td>
                <td>Ingeniería</td>
                <td class="acciones">
                    <button>Editar</button>
                    <button class="eliminar">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>
