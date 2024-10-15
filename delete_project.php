<?php
if (isset($_POST['id'])) {
    $projectId = intval($_POST['id']);
    $conexion = new mysqli("localhost", "root", "", "jardin");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "DELETE FROM `proyectos` WHERE ID = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $projectId);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "<script>alert('Error al eliminar el proyecto: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "ID de proyecto no proporcionado.";
}
?>
