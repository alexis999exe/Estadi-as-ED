<?php
// Parámetros de conexión
$serverName = "localhost"; // o el nombre/IP del servidor
$connectionOptions = [
    "Database" => "encuesta",   // Nombre de la base de datos
    "Uid" => "",      // Usuario de SQL Server
    "PWD" => "",   // Contraseña
    "CharacterSet" => "UTF-8"   // Para que acepte caracteres especiales
];

// Intentar la conexión
$conexion_encuesta = sqlsrv_connect($serverName, $connectionOptions);

// Validar conexión
if ($conexion_encuesta === false) {
    die("❌ Error al conectar con la base de datos 'encuesta': " . print_r(sqlsrv_errors(), true));
}
?>
