<?php
$conexion = new mysqli("localhost", "root", "", "jardin");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$id = $_POST['ID'];
$nombre = $_POST['Nombre'];
$descripcion = $_POST['Descripcion'];
$turno = $_POST['Turno'];
$salasId = $_POST['SalasID'];

if (isset($_FILES['Imagen']) && $_FILES['Imagen']['error'] == UPLOAD_ERR_OK) {
    $imagen = $_FILES['Imagen']['name'];
    $rutaImagen = 'uploads/' . basename($imagen);

    if (!move_uploaded_file($_FILES['Imagen']['tmp_name'], $rutaImagen)) {
        echo 'Error al subir la imagen.';
        exit;
    }
} else {
    $rutaImagen = isset($_POST['ImagenActual']) ? $_POST['ImagenActual'] : '';
}

$sql = "UPDATE proyectos SET Nombre = ?, Descripcion = ?, Imagen = ?, Turno = ?, Salas = ? WHERE ID = ?";
$stmt = $conexion->prepare($sql);

if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conexion->error);
}

$stmt->bind_param("sssiii", $nombre, $descripcion, $rutaImagen, $turno, $salasId, $id);

if ($stmt->execute()) {
    echo 'success';
} else {
    echo "<script>alert('Error en la actualización: " . $stmt->error . "');</script>";
}

$stmt->close();
$conexion->close();
?>