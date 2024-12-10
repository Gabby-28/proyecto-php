<?php
session_start();

// Verificar si el usuario está autenticado
// if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'doctor') {
//     header("Location: ../login.php");
//     exit();
// }
?>

<?php
$pageTitle = "Panel del Doctor";
$role = 'doctor';
include '../includes/header.php';
include '../includes/sidebar.php';

$view = $_GET['view'] ?? 'default'; // Se obtiene el valor de la variable 'view', si no hay se asigna 'default'

?>

<!-- Incluir el archivo CSS desde la carpeta correcta -->
<link rel="stylesheet" href="../assets/css/style.css">

<!-- Incluir CSS de Swiper -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<main id="main">
    <?php
    if ($view === 'pacientes') {
        // Mostrar la lista de pacientes
        include 'lista_pacientes.php'; 
    } else if ($view === 'citas') {
        // Mostrar el formulario para agendar citas
        include 'citas_agendadas.php'; 
    } else {
        // Si no se pasa ningún valor, mostrar el contenido predeterminado
        ?>
        <div class="header2">
            <div class="swiper mySwiper-1">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="slider">
                            <div class="slider-txt">
                                <h1>¡No olvides tus próximas consultas!</h1>
                                <p>Asegúrate de que tus pacientes estén confirmados y que tu agenda esté actualizada.</p>
                            </div>
                            <div class="slider-img">
                                <img src="../assets/img/img1.jpg" alt="Odontología">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slider">
                            <div class="slider-txt">
                                <h1>Tu información está segura con nosotros.</h1>
                                <p>Contamos con los más altos estándares de protección para datos de pacientes.</p>
                            </div>
                            <div class="slider-img">
                                <img src="../assets/img/img2.jpg" alt="Odontología">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <?php
    }
    ?>
</main>

<script src="../assets/js/app.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

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

</body>
</html>
