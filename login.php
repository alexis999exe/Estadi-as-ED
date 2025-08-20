<?php
session_start(); // Inicia la sesión para almacenar información del usuario

require_once 'conexion.php'; // Incluye el archivo de conexión

$mensaje_error = ''; // Variable para mensajes de error

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['matricula']) && isset($_POST['contrasena'])) {
    $matricula = trim($_POST['matricula']);
    $contrasena = trim($_POST['contrasena']);
    
    // Validación básica del código de usuario
    if (preg_match('/[^a-zA-Z0-9_-]/', $matricula)) {
        $mensaje_error = "El código de usuario no puede contener caracteres especiales.";
    } else {
        // Llamada al procedimiento almacenado
        $sql_sp = "{CALL paExisteUsuario(?, ?, ?)}";
        $existe_usuario = 0;
        $params_sp = array(
            array(&$matricula, SQLSRV_PARAM_IN),
            array(&$contrasena, SQLSRV_PARAM_IN),
            array(&$existe_usuario, SQLSRV_PARAM_OUT, null, SQLSRV_SQLTYPE_INT)
        );

        $stmt = sqlsrv_query($conexion, $sql_sp, $params_sp);

        if ($stmt === false) {
            die("❌ Error al ejecutar el procedimiento almacenado: " . print_r(sqlsrv_errors(), true));
        }

        if ($existe_usuario > 0) {
            // Obtener tipo de usuario
            $sql_get_tipo = "SELECT idtipoUsuario FROM secure_logins WHERE codigo = ?";
            $params_get_tipo = array(&$matricula);
            $stmt_get_tipo = sqlsrv_query($conexion, $sql_get_tipo, $params_get_tipo);

            if ($stmt_get_tipo === false) {
                die("❌ Error al obtener el tipo de usuario: " . print_r(sqlsrv_errors(), true));
            }

            $datos_usuario = sqlsrv_fetch_array($stmt_get_tipo, SQLSRV_FETCH_ASSOC);

            if ($datos_usuario) {
                $_SESSION['matricula'] = $matricula;
                $_SESSION['idtipoUsuario'] = $datos_usuario['idtipoUsuario'];
                $idTipoUsuario = $datos_usuario['idtipoUsuario'];

                // Si es Alumno, obtenemos nombre_completo
                if ($idTipoUsuario == 3) {
                    $sql_get_nombre = "SELECT nombre_completo FROM user_alumnos WHERE matricula = ?";
                    $params_get_nombre = array(&$matricula);
                    $stmt_nombre = sqlsrv_query($conexion, $sql_get_nombre, $params_get_nombre);

                    if ($stmt_nombre === false) {
                        error_log("Error al obtener nombre completo del alumno: " . print_r(sqlsrv_errors(), true));
                        $_SESSION['nombre_completo'] = 'Alumno';
                    } else {
                        $datos_nombre = sqlsrv_fetch_array($stmt_nombre, SQLSRV_FETCH_ASSOC);
                        if ($datos_nombre && isset($datos_nombre['nombre_completo'])) {
                            $_SESSION['nombre_completo'] = $datos_nombre['nombre_completo'];
                        } else {
                            $_SESSION['nombre_completo'] = 'Alumno';
                        }
                    }
                } elseif ($idTipoUsuario == 1) {
                    $_SESSION['nombre_completo'] = 'Administrador';
                } else {
                    $_SESSION['nombre_completo'] = 'Usuario';
                }

                // Redirección según tipo de usuario
                if ($idTipoUsuario == 1) {
                    header("Location: admin.php");
                    exit();
                } elseif ($idTipoUsuario == 3) {
                    header("Location: index.php");
                    exit();
                } else {
                    header("Location: index.php");
                    exit();
                }
            } else {
                $mensaje_error = "Error al obtener detalles del usuario.";
            }

        } else {
            $mensaje_error = "Credenciales incorrectas.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Evaluación Docente</title>
    <link rel="stylesheet" href="css/estilos-l.css">
    <style>
        .mensaje-error {
            background-color: #fdd;
            color: #a00;
            border: 1px solid #fbc;
            padding: 12px 20px;
            margin-top: 20px;
            border-radius: 6px;
            font-size: 1em;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-weight: normal;
        }
    </style>
</head>
<body class="login-body">

    <div class="login-container">
        <img src="imagenes/LogoUTZMG.png" alt="Logo de la Universidad" class="login-logo">

        <h2 class="login-title">Iniciar Sesión</h2>

        <form action="login.php" method="post" class="login-form">
            <label for="matricula">Matrícula/Código:</label>
            <input type="text" id="matricula" name="matricula" required>

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <button type="submit" class="btn-login">Ingresar</button>
        </form>

        <?php
        if ($mensaje_error) {
            echo '<p class="mensaje-error">';
            echo '<span>&#x2716;</span> ' . htmlspecialchars($mensaje_error);
            echo '</p>';
        }
        ?>
    </div>

</body>
</html>
