<div class="sidebar" id="sidebar">
    <nav>
        <ul>
            <li class="sidebar_item">
                <a href="dashboard.php?view=inicio" class="selected">
                    <img src="../assets/img/home.png" alt="inicio">
                    <span>INICIO</span>
                </a>
            </li>
            <li class="sidebar_item">
                <a href="dashboard.php?view=pacientes">
                    <img src="../assets/img/patient.png" alt="pacientes">
                    <span>PACIENTES</span>
                </a>
            </li>
            <li class="sidebar_item">
                <a href="dashboard.php?view=citas">
                    <img src="../assets/img/calendar.png" alt="calendario">
                    <span>CITAS</span>
                </a>
            </li>
            <?php if ($role === 'admin'): ?>
                <li class="sidebar_item">
                    <a href="dashboard.php?view=pagos">
                        <img src="../assets/img/money2.png" alt="pagos">
                        <span>PAGOS</span>
                    </a>
                </li>
                <li class="sidebar_item">
                    <a href="dashboard.php?view=personal">
                        <img src="../assets/img/dentista2.png" alt="personal">
                        <span>PERSONAL</span>
                    </a>
                </li>
            <?php else: ?>
                <li class="sidebar_item">
                    <a href="dashboard.php?view=notificaciones">
                        <img src="../assets/img/notifications.png" alt="notificaciones">
                        <span>NOTIFICACIONES</span>
                    </a>
                </li>
            <?php endif; ?>
            <li class="sidebar_item">
                <a href="dashboard.php?view=configuracion">
                    <img src="../assets/img/settings.png" alt="configuración">
                    <span>CONFIGURACIÓN</span>
                </a>
            </li>
        </ul>
    </nav>
    
    <div class="sidebar_profile">
        <ul>
            <li class="sidebar_item item--profile">
                <a href="dashboard.php?view=perfil">
                    <img src="../assets/img/user.jpg" alt="Imagen de perfil">
                    <span class="profile-option">Perfil</span>
                </a>
            </li>
            <li class="sidebar_item">
                <a href="../logout.php">
                    <img src="../assets/img/salir.png" alt="cerrar">
                    <span>Cerrar Sesión</span>
                </a>
            </li>
        </ul>
    </div>
</div>
