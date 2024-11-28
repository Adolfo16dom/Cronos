<?php
include("conexion.php");
session_start();

// Definir una variable para manejar los errores
$errores = [];

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Consultar el usuario en la base de datos
    $sql = "SELECT * FROM Usuario WHERE Correo_Electronico = '$usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El usuario existe, ahora verificamos la contraseña
        $row = $result->fetch_assoc();
        $password_hash = $row['Contraseña']; // Obtener la contraseña almacenada

        // Verificar si la contraseña ingresada coincide con la almacenada (usando password_verify)
        if (password_verify($password, $password_hash)) {
            // La contraseña es correcta, se inicia la sesión
            $_SESSION['usuario_id'] = $row['Clave_Usuario']; // Guardar el ID del usuario en la sesión
            $_SESSION['usuario_nombre'] = $row['Nombre_Usuario']; // Guardar el nombre del usuario

            // Redirigir a la página principal o el área protegida
            header("Location: index.php");
            exit();
        } else {
            // La contraseña es incorrecta
            $errores[] = "Contraseña incorrecta.";
        }
    } else {
        // El usuario no existe
        $errores[] = "El correo electrónico no está registrado.";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login</title>
    <link rel="stylesheet" href="login_estilo.css">

</head>
<body>
    <header style="display: flex; align-items: center; justify-content: center; padding: 10px;">
            <img src="imagenes/LogoRelojeria.png" alt="Logo" style="width: 100px; height: 100px;">
            <h1 id="cronos">CRONOS</h1>
    </header>
    <div class="contenedor">
    <!-- Mostrar el formulario de login -->
        <div class="wrapper">
            <form action="login.php" method="POST">
                <h1>Iniciar sesión</h1>

                <!-- Mostrar errores si existen -->
                <?php if (!empty($errores)): ?>
                    <div class="errores">
                        <?php foreach ($errores as $error): ?>
                            <p class="error"><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="input-box">
                    <input type="text" placeholder="Usuario" name="usuario" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">   
                    <input type="password" placeholder="Contraseña" name="password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" class="btn">Ingresar</button>
            
                <div class="register-link">
                    <p>¿No tienes una cuenta? <a href="register.php">Regístrate</a></p>
                </div>
                
            </form>
        </div>
    </div>
    
</body>
</html>
