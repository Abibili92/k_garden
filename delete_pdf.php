<?php
$conexion = new mysqli("localhost", "root", "", "jardin");

if ($conexion->connect_error) {
    echo "<script>alert('Conexión fallida: " . $conexion->connect_error . "');</script>";
    exit();
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $query = "SELECT PDF_Path FROM tu_tabla_pdf WHERE ID = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($pdfPath);
    $stmt->fetch();
    $stmt->close();

    if (file_exists($pdfPath)) {
        unlink($pdfPath);
    }

    $query = "DELETE FROM tu_tabla_pdf WHERE ID = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>window.location.href = 'admision.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el PDF: " . $stmt->error . "');</script>";
        echo "<script>window.location.href = 'admision.php';</script>";
    }

    $stmt->close();
}

$conexion->close();
?>
