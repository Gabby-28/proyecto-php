<?php
// Incluir la conexión a la base de datos
include('../includes/db.php');

// Inicializar la variable de mensaje (para mostrar notificaciones)
$message = '';

// Realizar una consulta para obtener los doctores (usuarios con rol 'doctor')
$sqlDoctores = "SELECT id, nombre FROM usuarios WHERE rol = 'doctor'";
$resultDoctores = $conn->query($sqlDoctores);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Paciente</title>
    <style>
        .notification {
            margin: 20px auto;
            padding: 10px;
            border: 1px solid transparent;
            border-radius: 5px;
            width: 90%;
            max-width: 500px;
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .error {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>
<body>
    <h2>Agregar Paciente</h2>
    <!-- Formulario -->
    <form action="agregar_paciente.php" method="POST">
        <div class="input-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div class="input-group">
            <label for="edad">Edad</label>
            <input type="number" id="edad" name="edad" required>
        </div>
        <div class="input-group">
            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono" required>
        </div>
        <div class="input-group">
            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" name="direccion" required>
        </div>
        <div class="input-group">
            <label for="historial">Historial</label>
            <textarea id="historial" name="historial" required></textarea>
        </div>
        <div class="input-group">
            <label for="doctor_id">Seleccionar Doctor</label>
            <select id="doctor_id" name="doctor_id" required>
                <?php
                // Verificar si hay resultados y mostrar en el dropdown
                if ($resultDoctores && $resultDoctores->num_rows > 0) {
                    while ($row = $resultDoctores->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay doctores disponibles</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit">Agregar Paciente</button>
    </form>

    <!-- Mostrar mensaje de éxito o error -->
    <?php if (!empty($message)) : ?>
        <div class="notification <?php echo strpos($message, 'correctamente') !== false ? 'success' : 'error'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
</body>
</html>
