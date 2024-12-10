<?php
include('../includes/db.php');

// Consultar las citas agendadas
$sql = "SELECT c.id, c.fecha, c.motivo, c.estado, 
               CONCAT(p.nombre) AS paciente, 
               CONCAT(d.nombre) AS doctor
        FROM citas c
        JOIN pacientes p ON c.paciente_id = p.id
        JOIN usuarios d ON c.doctor_id = d.id";

$citas = $conn->query($sql);
?>

<h2>Lista de Citas</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Paciente</th>
            <th>Doctor</th>
            <th>Fecha</th>
            <th>Motivo</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($cita = $citas->fetch_assoc()): ?>
            <tr>
                <td><?php echo $cita['id']; ?></td>
                <td><?php echo $cita['paciente']; ?></td>
                <td><?php echo $cita['doctor']; ?></td>
                <td><?php echo $cita['fecha']; ?></td>
                <td><?php echo $cita['motivo']; ?></td>
                <td><?php echo $cita['estado']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
