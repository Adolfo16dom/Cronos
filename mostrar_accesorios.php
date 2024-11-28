<?php
header('Content-Type: application/json');
include 'conexion.php';

$sql = "SELECT * FROM Producto  WHERE Clave_Producto IN (16,17,18,19,20,21)";
$result = $conn->query($sql);

$productos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = [
            'id' => $row['Clave_Producto'],
            'nombre' => $row['Nombre_Producto'],
            'descripcion' => $row['Descripcion'],
            'stock' => $row['Stock'],
            'precio' => $row['Precio'],
            'imagen_url' => $row['Imagen_URL']
        ];
    }
}

echo json_encode($productos);
$conn->close();
?> 
