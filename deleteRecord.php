<?php

$conn = new mysqli("localhost", "root", "", "jardin");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ID'])) {
    $id = $_POST['ID'];

    $sql = "DELETE FROM proyectos WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo "Registro eliminado exitosamente.";
    } else {
        echo "Error al eliminar el registro: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

header('Location: adminSala.php'); 
exit;
?>
