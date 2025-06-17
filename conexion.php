<?php
$host = "localhost";     // o 127.0.0.1
$usuario = "root";       // usuario por defecto en XAMPP
$contrasena = "";        // sin contraseña por defecto
$baseDeDatos = "Profesores";  // nombre de tu base de datos

$conexion = new mysqli($host, $usuario, $contrasena, $baseDeDatos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
} else {
    echo "Conexión exitosa a la base de datos.";
}
?>
