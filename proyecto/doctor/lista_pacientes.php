<?php
// Incluir el archivo de conexión a la base de datos
include '../includes/db.php';

// Obtener el término de búsqueda (si se ha enviado)
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Si hay un término de búsqueda, realiza la consulta filtrada
if ($search !== '') {
    $query = "SELECT * FROM pacientes WHERE nombre LIKE ? OR telefono LIKE ? OR direccion LIKE ?";
    $stmt = $conn->prepare($query);
    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Si no hay búsqueda, trae todos los pacientes
    $query = "SELECT * FROM pacientes";
    $result = $conn->query($query);
}

?>

<!-- Formulario de Búsqueda -->
<form method="GET" action="lista_pacientes.php">
    <input type="text" name="search" placeholder="Buscar paciente..." value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit">Buscar</button>
</form>

<!-- Tabla de Pacientes -->
<?php
if ($result->num_rows > 0) {
?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Edad</th>
                <th>Dirección</th>
                <th>Historial</th>
                <th>Doctor Asignado</th>
                <th>Fecha de Registro</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mostrar los resultados de la consulta
            while ($patient = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $patient['id']; ?></td>
                    <td><?php echo $patient['nombre']; ?></td>
                    <td><?php echo $patient['telefono']; ?></td>
                    <td><?php echo $patient['edad']; ?></td>
                    <td><?php echo $patient['direccion']; ?></td>
                    <td><?php echo $patient['historial']; ?></td>
                    <td><?php echo $patient['doctor_id']; ?></td>
                    <td><?php echo $patient['fecha_registro']; ?></td>
                    <td>
                        <!-- Enlace para ver el historial médico del paciente -->
                        <a href="historial_medico.php?id=<?php echo $patient['id']; ?>" class="btn">Ver Historial</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
} else {
    echo "No se encontraron pacientes.";
}

// Cerrar la conexión
$conn->close();
?>
