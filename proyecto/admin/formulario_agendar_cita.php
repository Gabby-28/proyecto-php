<?php
include('../includes/db.php');

$pacientes = $conn->query("SELECT id, CONCAT(nombre) AS nombre_completo FROM pacientes");
$doctores = $conn->query("SELECT id, CONCAT(nombre) AS nombre_completo FROM usuarios WHERE rol = 'doctor'");
?>

<h2>Agendar Cita</h2>
<form action="agregar_cita.php" method="POST">
    <div class="input-group">
        <label for="paciente_id">Seleccionar Paciente</label>
        <select id="paciente_id" name="paciente_id" required>
            <option value="">Seleccione un paciente</option>
            <?php while ($paciente = $pacientes->fetch_assoc()): ?>
                <option value="<?php echo $paciente['id']; ?>">
                    <?php echo $paciente['nombre_completo']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="input-group">
        <label for="doctor_id">Seleccionar Doctor</label>
        <select id="doctor_id" name="doctor_id" required>
            <option value="">Seleccione un doctor</option>  
            <?php while ($doctor = $doctores->fetch_assoc()): ?>
                <option value="<?php echo $doctor['id']; ?>">
                    <?php echo $doctor['nombre_completo']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="input-group">
        <label for="fecha">Fecha</label>
        <input type="text" id="fecha" name="fecha" required readonly>
    </div>

    <div class="calendar">
        <div class="calendar-header">
            <button id="prev-month">‹</button>
            <span id="month-year"></span>
            <button id="next-month">›</button>
        </div>

        <div class="days-of-week">
            <div>Dom</div>
            <div>Lun</div>
            <div>Mar</div>
            <div>Mié</div>
            <div>Jue</div>
            <div>Vie</div>
            <div>Sáb</div>
        </div>

        <div class="calendar-days" id="calendar-days"></div>
    </div>

    <div class="input-group">
        <label for="hora">Hora</label>
        <select id="hora" name="hora" required>
            <option value="">Seleccione la hora</option>
            <?php for ($h = 8; $h <= 18; $h++): ?>
                <option value="<?php echo str_pad($h, 2, '0', STR_PAD_LEFT); ?>">
                    <?php echo str_pad($h, 2, '0', STR_PAD_LEFT); ?>:00
                </option>
            <?php endfor; ?>
        </select>
    </div>
    <div class="input-group">
        <label for="minuto">Minuto</label>
        <select id="minuto" name="minuto" required>
            <option value="">Seleccione los minutos</option>
            <option value="00">00</option>
            <option value="15">15</option>
            <option value="30">30</option>
            <option value="45">45</option>
        </select>
    </div>
    <div class="input-group">
        <label for="motivo">Motivo</label>
        <textarea id="motivo" name="motivo"></textarea>
    </div>
    <button type="submit">Agendar Cita</button>
</form>

<!-- Estilos y Scripts -->
<style>
    .calendar {
        width: 300px;
        margin: 0 auto;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        font-family: Arial, sans-serif;
    }
    .calendar-header {
        text-align: center;
        margin-bottom: 10px;
    }
    .calendar-header button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 5px 10px;
        font-size: 16px;
        cursor: pointer;
    }
    .calendar-header button:hover {
        background-color: #0056b3;
    }
    .days-of-week {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        text-align: center;
        margin-bottom: 10px;
        font-weight: bold;
    }
    .calendar-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
        text-align: center;
    }
    .day {
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
    }
    .day:hover {
        background-color: #f1f1f1;
    }
    .day.selected {
        background-color: #007bff;
        color: white;
    }
</style>

<script>
    const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    let currentDate = new Date();
    let selectedDay = null;

    function renderCalendar() {
        const month = currentDate.getMonth();
        const year = currentDate.getFullYear();
        
        document.getElementById('month-year').textContent = `${monthNames[month]} ${year}`;
        
        const firstDayOfMonth = new Date(year, month, 1);
        const lastDayOfMonth = new Date(year, month + 1, 0);
        
        const daysInMonth = lastDayOfMonth.getDate();
        const firstDayOfWeek = firstDayOfMonth.getDay(); 
        
        const calendarDays = document.getElementById('calendar-days');
        calendarDays.innerHTML = '';
        
        for (let i = 0; i < firstDayOfWeek; i++) {
            const emptyCell = document.createElement('div');
            calendarDays.appendChild(emptyCell);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dayCell = document.createElement('div');
            dayCell.classList.add('day');
            dayCell.textContent = day;
            dayCell.addEventListener('click', () => selectDay(day));
            calendarDays.appendChild(dayCell);
        }
    }

    function selectDay(day) {
        selectedDay = day;
        const days = document.querySelectorAll('.day');
        days.forEach(d => d.classList.remove('selected'));
        const selected = [...days].find(d => d.textContent == day);
        selected.classList.add('selected');
        updateSelectedTime();
    }

    function updateSelectedTime() {
        if (selectedDay !== null) {
            const hour = document.getElementById('hora').value;
            const minute = document.getElementById('minuto').value;

            const year = currentDate.getFullYear();
            const month = String(currentDate.getMonth() + 1).padStart(2, '0'); 
            const day = String(selectedDay).padStart(2, '0');
            
            const formattedDate = `${year}-${month}-${day}`;
            const formattedTime = `${hour}:${minute}:00`;

            document.getElementById('fecha').value = formattedDate;
            document.getElementById('hora').value = formattedTime;  // Opcional: Si quieres mostrar la hora también
        }
    }

    document.getElementById('prev-month').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    document.getElementById('next-month').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    renderCalendar();
</script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $paciente_id = $_POST['paciente_id'];
    $doctor_id = $_POST['doctor_id'];
    $fecha = $_POST['fecha'];  // La fecha debe estar en formato 'YYYY-MM-DD'
    $hora = $_POST['hora'];    // La hora debe estar en formato 'HH:MM:SS'
    $motivo = $_POST['motivo'];

    // Inserción en la base de datos
    $query = "INSERT INTO citas (paciente_id, doctor_id, fecha, hora, motivo) 
              VALUES ('$paciente_id', '$doctor_id', '$fecha', '$hora', '$motivo')";
    
    if ($conn->query($query) === TRUE) {
        echo "Cita agendada correctamente";
    } else {
        echo "Error al agendar cita: " . $conn->error;
    }
}
?>

