<?php

if (isset($_POST['id'])) {
    $userId = intval($_POST['id']);
    $conexion = mysqli_connect("localhost", "root", "", "jardin");

    if (!$conexion) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "DELETE FROM `login` WHERE id = '$userId'";
    if (mysqli_query($conexion, $sql)) {
        echo "<script>
                window.location.href = 'newuser.php'; // Cambia esto por la página a la que quieras redirigir
              </script>";
    } else {
        echo "<script>
        alert('Error: " . mysqli_error($conexion) . "');
        window.location.href = 'newuser.php'; // Cambia esto por la página a la que quieras redirigir
      </script>";
    }

    mysqli_close($conexion);
} else {
    echo "<script>
    alert('ID de nota no proporcionado.');
    window.location.href = 'newuser.php'; // Cambia esto por la página a la que quieras redirigir
  </script>";
}
?>