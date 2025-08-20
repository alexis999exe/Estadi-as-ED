<?php
// Datos de conexión a SQL Server
$serverName = "localhost"; // o "localhost\\SQLEXPRESS" si usas una instancia
$connectionInfo = array(
    "Database" => "Horarios", // Nombre de la base de datos
    "UID" => "",              // Usuario de SQL Server (deja vacío si usas autenticación de Windows)
    "PWD" => "",              // Contraseña del usuario
    "CharacterSet" => "UTF-8"
);

// Establecer la conexión
$conexion = sqlsrv_connect($serverName, $connectionInfo);

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . print_r(sqlsrv_errors(), true));
}
?>
