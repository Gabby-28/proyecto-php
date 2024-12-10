<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include('./includes/db.php'); 

// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $id = $_POST['id'] ?? ''; 
//     $password = $_POST['password'] ?? ''; 

    // Validar campos vacíos
    // if (empty($id) || empty($password)) {
    //     $errorMessage = "Por favor, ingrese su ID y contraseña.";
    // } else {
        // Consulta a la base de datos para obtener usuario por ID
        // $sql = "SELECT id, password, rol FROM usuarios WHERE id = ?";
        // $stmt = $conn->prepare($sql);
        // $stmt->bind_param("i", $id); // 'i' para el tipo integer
        // $stmt->execute();
        // $result = $stmt->get_result();

        // if ($result->num_rows > 0) {
        //     $user = $result->fetch_assoc();

            // Verificar la contraseña
            // if (password_verify($password, $user['password'])) {
                // Guardar los datos del usuario en la sesión
                // $_SESSION['user_id'] = $user['id'];
                // $_SESSION['role'] = $user['rol'];

                // Redirigir según el rol
//                 if ($user['rol'] === 'admin') {
//                     header("Location: admin/dashboard.php");
//                 } elseif ($user['rol'] === 'doctor') {
//                     header("Location: doctor/dashboard.php");
//                 } else {
//                     $errorMessage = "Rol desconocido. Contacte al administrador.";
//                 }
//                 exit();
//             } else {
//                 $errorMessage = "Contraseña incorrecta.";
//             }
//         } else {
//             $errorMessage = "Usuario no encontrado.";
//         }
//     }
// }
// ?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Plataforma de Clínica</title>
    <link rel="stylesheet" href="./assets/css/syle.css">
</head>
<body class="fondo-body">
<img src="./assets/img/fondo2.jpg" alt="fondo">
    <main>
        <div class="login-container">
            <h2>Iniciar Sesión</h2>
            <form action="login.php" method="POST" id="loginForm">
                <div class="input-group">
                    <label for="id">Usuario</label>
                    <input type="text" id="id" name="id" required>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button class="button-login" type="submit">Iniciar Sesión</button>
            </form>
            
            <?php if (!empty($errorMessage)) : ?>
                <p id="errorMessage" class="error-message"><?php echo $errorMessage; ?></p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>


