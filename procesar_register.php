<?php
include("conexion.php");

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$confirmar_contrasena = $_POST['confirmar_contrasena'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$genero = $_POST['genero'];
$metodo_pago = $_POST['metodo_pago'];

// Validaciones básicas
$errores = [];
// Validar correo único
$sql = "SELECT * FROM Usuario WHERE Correo_Electronico = '$correo'";
$resultado = $conn->query($sql);
if ($resultado->num_rows > 0) {
    $errores[] = "El correo electrónico ya está registrado.";
}
// Validar si las contraseñas coinciden
if ($contrasena !== $confirmar_contrasena) {
    $errores[] = "La contraseña y la confirmación no coinciden.";
}
// Validar longitud del teléfono
if (strlen($telefono) > 15) {
    $errores[] = "El teléfono no puede exceder los 15 caracteres.";
}
// Validar fecha de nacimiento
if ($fecha_nacimiento > date('Y-m-d')) {
    $errores[] = "La fecha de nacimiento no puede ser en el futuro.";
}
// Validar dirección
if (strlen($direccion) > 100) {
    $errores[] = "La dirección no puede exceder los 100 caracteres.";
}
// Validar género
if (!in_array($genero, ['masculino', 'femenino', 'otro'])) {
    $errores[] = "El género seleccionado no es válido.";
}
// Validar método de pago
if (!in_array($metodo_pago, ['tarjeta_credito', 'tarjeta_debito', 'paypal'])) {
    $errores[] = "El método de pago seleccionado no es válido.";
}
// Si hay errores, mostrar y detener la ejecución
if (!empty($errores)) {
    foreach ($errores as $error) {
        echo "<p>Error: $error</p>";
    }
    exit;
}
// Encriptar la contraseña
$contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
// Insertar datos en la base de datos
$sql = "INSERT INTO Usuario 
        (Nombre_Usuario, Correo_Electronico, Contraseña, Direccion, Telefono, Fecha_Nacimiento, Genero, Clave_Metodo_Pago) 
        VALUES 
        ('$nombre', '$correo', '$contrasena_hash', '$direccion', '$telefono', '$fecha_nacimiento', '$genero', 
        (SELECT Clave_Metodo_Pago FROM Metodo_Pago WHERE Metodo_Pago = '$metodo_pago'))";

if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso. Usuario creado correctamente.";
    // Redirigir a la página principal o el área protegida
    header("Location: login.php");
    exit();
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
