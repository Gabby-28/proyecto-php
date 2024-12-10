<?php
// Conexión a la base de datos
include '../includes/db.php';

// Obtener los datos del formulario
$paciente_id = $_POST['paciente_id'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$apellido = $_POST['apellido'] ?? '';
$documento = $_POST['documento'] ?? '';
$fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
$edad = $_POST['edad'] ?? '';
$peso = $_POST['peso'] ?? '';
$ocupacion = $_POST['ocupacion'] ?? '';
$tipo_sangre = $_POST['tipo_sangre'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$ultima_consulta = $_POST['ultima_consulta'] ?? '';
$alergias = $_POST['alergias'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$correo = $_POST['correo'] ?? '';
$habitos_diarios = $_POST['habitos_diarios'] ?? '';
$medicamentos_tomados = $_POST['medicamentos_tomados'] ?? '';
$procedimientos_realizado = $_POST['procedimientos_realizado'] ?? '';
$datos_clinicos = $_POST['datos_clinicos'] ?? '';

// Comprobar si el documento ya existe en la base de datos
$query = "SELECT COUNT(*) FROM historial_medico WHERE documento = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $documento);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close(); // Cerrar el statement de la consulta anterior

if ($count > 0) {
    echo "El documento ya está registrado.";
    exit(); // Detener el script si el documento ya está en la base de datos
}

// Si el documento no existe, puedes proceder con la inserción
$query = "INSERT INTO historial_medico 
    (paciente_id, nombre, apellido, documento, fecha_nacimiento, edad, peso, ocupacion, tipo_sangre, descripcion, ultima_consulta, alergias, telefono, direccion, correo, habitos_diarios, medicamentos_tomados, procedimientos_realizado, datos_clinicos, fecha_registro) 
    VALUES 
    (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

// Preparar la consulta
$stmt = $conn->prepare($query);

// Asegúrate de que el número de parámetros coincida con el número de columnas
$stmt->bind_param("issssssssssssssssss", 
    $paciente_id, 
    $nombre, 
    $apellido, 
    $documento, 
    $fecha_nacimiento, 
    $edad, 
    $peso, 
    $ocupacion, 
    $tipo_sangre, 
    $descripcion, 
    $ultima_consulta, 
    $alergias, 
    $telefono, 
    $direccion, 
    $correo, 
    $habitos_diarios, 
    $medicamentos_tomados, 
    $procedimientos_realizado, 
    $datos_clinicos);

if ($stmt->execute()) {
    echo "Historial médico creado exitosamente.";
} else {
    echo "Error al crear el historial médico: " . $stmt->error;
}

$stmt->close();
?>

