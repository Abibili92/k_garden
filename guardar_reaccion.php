<?php
$conexion = new mysqli("localhost", "root", "", "jardin");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $publicacion_id = $_POST['publicacion_id'];
    $reaccion = $_POST['reaccion'];
    $user_ip = $_SERVER['REMOTE_ADDR'];

    $checkQuery = "SELECT * FROM `reacciones` WHERE `Publicacion_ID` = ? AND `Usuario_IP` = ?";
    $stmt = $conexion->prepare($checkQuery);

    if ($stmt === false) {
        echo "error: prepare failed";
        exit;
    }

    $stmt->bind_param("is", $publicacion_id, $user_ip);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "error: ya has reaccionado a esta publicación.";
    } else {
        $insertQuery = "INSERT INTO `reacciones`(`Publicacion_ID`, `Usuario_IP`, `Reaccion`) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($insertQuery);

        if ($stmt === false) {
            echo "error: prepare failed";
            exit;
        }

        $stmt->bind_param("iss", $publicacion_id, $user_ip, $reaccion);

        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error: execute failed";
        }
    }

    $stmt->close();
    $conexion->close();
}
?>