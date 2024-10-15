<?php
$conexion = mysqli_connect("localhost", "root", "", "jardin");

if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['ID'], $data['DNI'], $data['Nombre'], $data['ROL'], $data['Password'])) {
    $notaId = $data['ID'];
    $DNI = $data['DNI'];
    $NOMBRE = $data['Nombre'];
    $ROL = $data['ROL'];
    $PASSWORD = $data['Password'];

    if (empty($DNI) || empty($NOMBRE) || empty($ROL) || empty($PASSWORD)) {
        echo 'error: Datos incompletos';
        exit;
    }

    $hashedPassword = password_hash($PASSWORD, PASSWORD_DEFAULT);

    $stmt = $conexion->prepare("UPDATE `login` SET DNI = ?, NOMBRE = ?, ROL = ?, CONTRASEÑA = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $DNI, $NOMBRE, $ROL, $hashedPassword, $notaId);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo "<script>alert('Error en la actualización: " . $stmt->error . "');</script>";
    }
} else {
    echo "<script>alert('Error: Datos incompletos');</script>";
}

mysqli_close($conexion);
?>
