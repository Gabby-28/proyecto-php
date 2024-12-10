<?php
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paciente_id = $_POST['paciente_id'];
    $doctor_id = $_POST['doctor_id'];
    $fecha = $_POST['fecha'];
    $motivo = $_POST['motivo'];
    $estado = 'pendiente'; // Estado predeterminado

    $sql = "INSERT INTO citas (paciente_id, doctor_id, fecha, motivo, estado) 
            VALUES ('$paciente_id', '$doctor_id', '$fecha', '$motivo', '$estado')";

    if ($conn->query($sql) === TRUE) {
        header('Location: dashboard.php?view=citas&success=1'); // Redirige al dashboard con un mensaje de éxito
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
