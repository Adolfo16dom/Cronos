<?php
header('Content-Type: application/json');
include 'conexion.php';

// Obtener el tipo desde los parámetros GET
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';

$sql = "SELECT * FROM Producto";

// Modificar la consulta según el tipo
if ($tipo === 'index') {
    $sql .= " WHERE Clave_Producto IN (1, 2, 3,4,5,6,7,8,9)"; // Cambia los IDs según tus productos
} elseif ($tipo === 'hombres') {
    $sql .= " WHERE Clave_Producto IN (1,3,5,7,9,10,11,12,13)"; // Cambia los IDs según tus productos
} elseif ($tipo === 'mujeres') {
    $sql .= " WHERE Clave_Producto IN (2,4,6,8,14,15)"; // Cambia los IDs según tus productos
}

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
            'tamanio_caja' => $row['Tamanio_Caja'],
            'movimiento' => $row['Movimiento'],
            'material_correa' => $row['Material_Correa'],
            'color_correa' => $row['Color_Correa'],
            'resistencia_agua' => $row['Resistencia_Agua'],
            'material_caja' => $row['Material_Caja'],
            'imagen_url' => $row['Imagen_URL']
        ];
    }
}

echo json_encode($productos);
$conn->close();





/*
header('Content-Type: application/json');
include 'conexion.php';

$sql = "SELECT * FROM Producto";
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
            'tamanio_caja' => $row['Tamanio_Caja'],
            'movimiento' => $row['Movimiento'],
            'material_correa' => $row['Material_Correa'],
            'color_correa' => $row['Color_Correa'],
            'resistencia_agua' => $row['Resistencia_Agua'],
            'material_caja' => $row['Material_Caja'],
            'imagen_url' => $row['Imagen_URL']
        ];
    }
}

echo json_encode($productos);
$conn->close();*/
?> 
