
<?php
$db_url = getenv('MySQL_MYSQL_URL');
$db = parse_url($db_url);

$db_host = getenv('DB_HOST');  // Esto lo obtienes desde las variables de Railway
$db_user = getenv('DB_USER');
$db_password = getenv('DB_PASSWORD');
$db_name = getenv('DB_NAME');
$db_port = getenv('DB_PORT');

// Crear conexión
$conn = new mysqli($db_host, $db_user, $db_password, $db_name, $db_port);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa a la base de datos!";
