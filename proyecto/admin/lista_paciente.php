<?php
// Incluir la conexión a la base de datos
include('../includes/db.php');

// Consultar la tabla de pacientes
$sql = "SELECT p.id, p.nombre, p.edad, p.telefono, p.direccion, u.nombre AS doctor
        FROM pacientes p
        JOIN usuarios u ON p.doctor_id = u.id";
$result = $conn->query($sql);

// Mostrar la lista en una tabla
echo "<h2>Lista de Pacientes</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Nombre</th><th>Edad</th><th>Teléfono</th><th>Dirección</th><th>Doctor</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['nombre'] . "</td>";
    echo "<td>" . $row['edad'] . "</td>";
    echo "<td>" . $row['telefono'] . "</td>";
    echo "<td>" . $row['direccion'] . "</td>";
    echo "<td>" . $row['doctor'] . "</td>";
    echo "</tr>";
}
echo "</table>";

// Cerrar la conexión
$conn->close();
?>
