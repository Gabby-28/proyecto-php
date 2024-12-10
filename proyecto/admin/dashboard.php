<?php
session_start();

// Verificar si el usuario está autenticado
// if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
//     header("Location: ../login.php");
//     exit();
// }
?>

<?php
$pageTitle = "Administración";
$role = 'admin';
include '../includes/header.php';
include '../includes/sidebar.php';

$view = $_GET['view'] ?? 'default';
?>

<!-- Incluir el archivo CSS desde la carpeta correcta -->
<link rel="stylesheet" href="../assets/css/style.css">

<!-- Incluir CSS de Swiper -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<main id="main">
    <?php
    if ($view === 'pacientes') {
        include 'formulario_pacientes.php'; 
        echo "<hr>"; 
        include 'lista_paciente.php'; 
    } else if($view === 'citas'){
        include 'formulario_agendar_cita.php'; 
        echo "<hr>"; 
        include 'lista_citas.php'; 
    } else if($view === 'pagos'){
        // No hay contenido para pagos
    } else if($view === 'personal'){
        include 'lista_doctores.php';
    } else if($view === 'notificaciones'){
        // No hay contenido para notificaciones
    } else if($view === 'configuracion'){
        // No hay contenido para configuraciones
    } else if($view === 'perfil'){
        // No hay contenido para perfil
    } else {
    ?>
    <div class="header2">
        <div class="swiper mySwiper-1">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="slider">
                        <div class="slider-txt1">
                            <h1>Recuerda mantener tus registros médicos actualizados</h1>
                            <p>Cumple con las normativas locales de privacidad y seguridad.</p>
                        </div>
                        <div class="slider-img">
                            <img src="../assets/img/registros-medicos.jpg" alt="Odontología">
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slider">
                        <div class="slider-txt1">
                            <h1>Nueva Funcionalidad: Reportes Personalizados</h1>
                            <p>Ahora puedes generar reportes detallados de pacientes, ingresos y estadísticas.</p>
                        </div>
                        <div class="slider-img">
                            <img src="../assets/img/informe.jpg" alt="Odontología">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Botones de navegación -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <!-- Paginación -->
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- Accesos rápidos -->
    <div class="quick-access">
        <h2>Accesos Rápidos</h2>
        <div class="access-box">
            <!-- Acceso rápido a Pacientes -->
            <div class="access-item" >
                <a href="?view=pacientes" class="btn-access">
                    <i class="fas fa-users"></i>
                    <span>Pacientes</span>
                </a>
            </div>

            <!-- Acceso rápido a Citas -->
            <div class="access-item">
                <a href="?view=citas" class="btn-access">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Citas</span>
                </a>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</main>

<!-- Incluir JS de Swiper -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- Incluir Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Inicialización de Swiper -->
<script>
  var swiper = new Swiper('.mySwiper-1', {
    loop: true, // Hacer que el slider se repita
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true, // Permitir la paginación con clic
    },
    autoplay: {
      delay: 5000, // Intervalo de 5 segundos entre slides
    },
  });
</script>

<script src="../assets/js/app.js"></script>

</body>
</html>



