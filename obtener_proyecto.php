<?php
if (isset($_GET['id'])) {
    $projectId = intval($_GET['id']);
    $conexion = new mysqli("localhost", "root", "", "jardin");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "SELECT * FROM `proyectos` WHERE ID = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(null);
    }

    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(null);
}
?>
