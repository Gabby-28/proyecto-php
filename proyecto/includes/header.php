<?php
// Incluir conexión a la base de datos
require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="../assets/css/syle.css">
    <!-- Estilos de Swiper -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- Script de Swiper -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

</head>
<body>
<header>
    <div class="left">
        <div class="menu-container">
            <div class="menu" id="menu">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="brand">
            <img src="../assets/img/logo.png" alt="logo" class="logo">
            <span class="name">Clínica Odontológica</span>
        </div>
    </div>
    <div class="right">
        <a href="#" class="icons-header">
            <img src="../assets/img/user.jpg" alt="usuario">
        </a>
        <a href="logout.php" class="icons-header">
            <img src="../assets/img/salir.png" alt="cerrar">
        </a>
    </div>
</header>
