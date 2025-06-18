<?php
$serverName = "localhost";  // doble backslash para instancia
$connectionOptions = [
    "Database" => "utzmg",         // nombre de tu base de datos
    "Uid" => "",                   // usuario (si usas SQL Auth)
    "PWD" => "",                   // contraseña (si usas SQL Auth)
    "TrustServerCertificate" => true,  // para evitar error SSL
    "Authentication" => 1          // 1 = Windows Authentication
];

// Conexión con autenticación de Windows
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "✅ Conexión exitosa a SQL Server.";
}
?>


