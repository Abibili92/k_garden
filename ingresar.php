<?php
session_start();

$conexion = mysqli_connect("localhost", "root", "", "jardin");

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$DNI = $_POST['DNI'];
$Contraseña = $_POST['Contraseña'];

$query = "SELECT * FROM `login` WHERE `DNI` = '$DNI'";
$result = mysqli_query($conexion, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    // Verificar la contraseña hasheada
    if (password_verify($Contraseña, $row['CONTRASEÑA'])) {
        $_SESSION['rol_usuario'] = $row['ROL'];
        $_SESSION['id_usuario'] = $row['id']; // Guardar el id_usuario en la sesión
        header("Location: newproyect.php");
        exit();
    } else {
        echo "<script>
        alert('Datos incorrectos. Verifique su usuario.');
        window.location.href = 'ingresar.html'; // Cambia esto por la página a la que quieras redirigir
      </script>";
    }
} else {
    echo "<script>
    alert('Datos incorrectos. Verifique su usuario.');
    window.location.href = 'ingresar.html'; // Cambia esto por la página a la que quieras redirigir
  </script>";
}

mysqli_close($conexion);
exit();

?>
