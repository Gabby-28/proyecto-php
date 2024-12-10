<?php
// Conexión a la base de datos
include '../includes/db.php';

// Obtener el ID del paciente desde la URL
$patient_id = isset($_GET['id']) ? $_GET['id'] : 0;

// Verificar si el ID del paciente es válido
if ($patient_id > 0) {
    // Consulta para obtener el historial médico del paciente
    $query = "SELECT * FROM historial_medico WHERE paciente_id = ?";    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        // Mostrar historial médico
        while ($row = $result->fetch_assoc()) {
            echo "<h2>Historial Médico de " . $row['nombre'] . " " . $row['apellido'] . "</h2>";
            echo "<p><strong>Documento:</strong> " . $row['documento'] . "</p>";
            echo "<p><strong>Fecha de Nacimiento:</strong> " . $row['fecha_nacimiento'] . "</p>";
            echo "<p><strong>Edad:</strong> " . $row['edad'] . "</p>";
            echo "<p><strong>Peso:</strong> " . $row['peso'] . " kg</p>";
            echo "<p><strong>Ocupación:</strong> " . $row['ocupacion'] . "</p>";
            echo "<p><strong>Tipo de Sangre:</strong> " . $row['tipo_sangre'] . "</p>";
            echo "<p><strong>Descripción:</strong> " . $row['descripcion'] . "</p>";
            echo "<p><strong>Última Consulta:</strong> " . $row['ultima_consulta'] . "</p>";
            echo "<p><strong>Alergias:</strong> " . $row['alergias'] . "</p>";
            echo "<p><strong>Teléfono:</strong> " . $row['telefono'] . "</p>";
            echo "<p><strong>Dirección:</strong> " . $row['direccion'] . "</p>";
            echo "<p><strong>Correo:</strong> " . $row['correo'] . "</p>";
            echo "<p><strong>Hábitos Diarios:</strong> " . $row['habitos_diarios'] . "</p>";
            echo "<p><strong>Medicamentos Tomados:</strong> " . $row['medicamentos_tomados'] . "</p>";
            echo "<p><strong>Procedimientos Realizados:</strong> " . $row['procedimiento_realizado'] . "</p>";
            echo "<p><strong>Datos Clínicos:</strong> " . $row['datos_clinicos'] . "</p>";
            echo "<p><strong>Fecha de Registro:</strong> " . $row['fecha_registro'] . "</p>";
            echo "<hr>";
        }
    } else {
        echo "No hay historial médico disponible para este paciente.";
    }

    // Mostrar el botón para crear un nuevo historial médico
    echo "<a href='crear_historial.php?id=$patient_id' class='btn'>Crear Nuevo Historial Médico</a>";
} else {
    echo "ID de paciente no válido.";
}

// Cerrar la conexión
$conn->close();
?>
