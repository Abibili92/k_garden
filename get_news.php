<?php
if (isset($_GET['id'])) {
    $conexion = new mysqli("localhost", "root", "", "jardin");
    
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $id = intval($_GET['id']);
    $query = "SELECT ID, Nombre, Descripcion FROM news WHERE ID = $id";
    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode([]);
    }

    $conexion->close();
}
?>
