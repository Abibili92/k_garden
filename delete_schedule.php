<?php
$conexion = mysqli_connect("localhost", "root", "", "jardin");

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM horarios WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "<script>
            window.location.href = 'newuser.php'; // Cambia esto por la página a la que quieras redirigir
          </script>";
        } else {
            echo "<script>
            alert('No se encontró el horario.');
            window.location.href = 'newuser.php'; // Cambia esto por la página a la que quieras redirigir
          </script>";
        }
    } else {
        echo "<script>
                alert('Error al borrar el horario: " . $stmt->error . "');
                window.location.href = 'newuser.php'; // Cambia esto por la página a la que quieras redirigir
              </script>";
    }

    $stmt->close();
} $stmt->close();

mysqli_close($conexion);
?>
