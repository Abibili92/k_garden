<?php
session_start();

$conexion = mysqli_connect("localhost", "root", "", "jardin");

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$DNI = $_POST['DNI'];
$Nombre = $_POST['Nombre'];
$Password = $_POST['Password'];
$Rol = $_POST['select'];

$hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

$checkDNIQuery = "SELECT * FROM `login` WHERE `DNI` = '$DNI'";
$result = mysqli_query($conexion, $checkDNIQuery);

if (mysqli_num_rows($result) > 0) {
    echo "<script>alert('El DNI ya está registrado.'); window.location.href='newuser.php';</script>";
    mysqli_close($conexion);
    exit();
} else {
    $query = "INSERT INTO `login`(`DNI`, `CONTRASEÑA`, `ROL`, `NOMBRE`) VALUES ('$DNI','$hashedPassword','$Rol','$Nombre')";
    if (mysqli_query($conexion, $query)) {
        echo "<script>alert('Usuario registrado con éxito.'); window.location.href='newuser.php';</script>";
    } else {
        echo "<script>alert('Error al registrar el usuario.'); window.location.href='newuser.php';</script>";
    }
}

mysqli_close($conexion);
exit();
?>
