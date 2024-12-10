<?php
$host = "localhost";        // Servidor
$user = "root";             // Usuario de la base de datos
$password = "";             // Contraseña
$dbname = "proyecto";    // Nombre de la base de datos

// Crear conexión con MySQLi
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
