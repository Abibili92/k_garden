<?php
session_start();

$conexion = mysqli_connect("localhost", "root", "", "jardin");

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$id = $_POST['id'];

$query = "SELECT * FROM `login` WHERE `id` = '$id'";
$result = mysqli_query($conexion, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $userData = array(
        'id' => $row['id'],
        'DNI' => $row['DNI'],
        'Nombre' => $row['NOMBRE'],
        'ROL' => $row['ROL']
    );

    echo json_encode($userData);
} else {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(array('error' => 'Usuario no encontrado'));
}

mysqli_close($conexion);
?>
