<?php
// Incluir conexión a la base de datos
include('../includes/db.php');

// Inicializar variable de búsqueda
$search = '';

// Verificar si se envió una solicitud de búsqueda
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}

// Preparar consulta SQL con parámetros (protección contra inyección SQL)
$sql = "SELECT id, nombre, email, rol, telefono, fecha_creacion, observaciones
        FROM usuarios 
        WHERE rol = 'doctor' AND (id LIKE ? OR email LIKE ?)";

// Preparar la sentencia
$stmt = $conn->prepare($sql);

// Asegurarnos de que el término de búsqueda se utilice en formato '%término%'
$searchTerm = '%' . $search . '%';

// Vincular parámetros
$stmt->bind_param("ss", $searchTerm, $searchTerm);

// Ejecutar la consulta
$stmt->execute();

// Obtener los resultados
$result = $stmt->get_result();
?>

<h2>Lista de Doctores</h2>

<!-- Formulario de búsqueda -->
<form action="" method="POST">
    <input type="text" name="search" placeholder="Buscar por ID o Email" value="<?php echo $search; ?>" required>
    <button type="submit">Buscar</button>
</form>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Teléfono</th>
            <th>Fecha de Registro</th>
            <th>Observaciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['rol']; ?></td>
                    <td><?php echo $row['telefono']; ?></td>
                    <td><?php echo $row['fecha_creacion']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No se encontraron doctores registrados.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
// Cerrar la sentencia y la conexión
$stmt->close();
$conn->close();
?>
