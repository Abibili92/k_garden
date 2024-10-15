<?php
$conexion = mysqli_connect("localhost", "root", "", "jardin");

if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    
    $stmt = $conexion->prepare("SELECT DNI, NOMBRE, ROL, CONTRASEÑA FROM `login` WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode([]);
    }
    
    $stmt->close();
}

mysqli_close($conexion);
?>
