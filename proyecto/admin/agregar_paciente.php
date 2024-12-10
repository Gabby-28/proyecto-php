<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Incluir la conexión a la base de datos
include('../includes/db.php');

// Inicializar la variable de mensaje
$message = '';

// Procesar el formulario si se envía una solicitud POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $historial = $_POST['historial'];
    $doctor_id = $_POST['doctor_id'];
    $fecha_registro = date('Y-m-d H:i:s');

    // Consulta para insertar el paciente
    $sql = "INSERT INTO pacientes (nombre, edad, telefono, direccion, historial, doctor_id, fecha_registro) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sisssis", $nombre, $edad, $telefono, $direccion, $historial, $doctor_id, $fecha_registro);

        if ($stmt->execute()) {
            // Redirigir a la misma página después de la inserción exitosa
            header("Location: agregar_paciente.php");
            exit(); // Termina la ejecución del script aquí para evitar cualquier salida posterior
        } else {
            $message = "Error al agregar paciente: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "Error al preparar la consulta: " . $conn->error;
    }
}

// Realizar una consulta para obtener los doctores (usuarios con rol 'doctor')
$sqlDoctores = "SELECT id, nombre FROM usuarios WHERE rol = 'doctor'";
$resultDoctores = $conn->query($sqlDoctores);
?>

