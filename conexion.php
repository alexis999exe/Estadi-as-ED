<?php
$serverName = "localhost";
$connectionInfo = array(
    "Database" => "utsyn",
    "UID" => "",         // ← pon tu usuario de SQL Server
    "PWD" => "",      // ← pon tu contraseña
    "CharacterSet" => "UTF-8"
);

$conexion = sqlsrv_connect($serverName, $connectionInfo);

if (!$conexion) {
    die("❌ Error al conectar a la base de datos: " . print_r(sqlsrv_errors(), true));
}
?>
