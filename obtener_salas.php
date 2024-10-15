<?php
$conexion = new mysqli("localhost", "root", "", "jardin");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$sql = "SELECT ID, Salas FROM salas";
$resultado = $conexion->query($sql);

$salas = array();

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $salas[] = $fila;
    }
}

echo json_encode($salas);

$conexion->close();
?>
