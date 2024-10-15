<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "jardin");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ID'])) {
    $id = intval($_POST['ID']);
    $sql = "DELETE FROM salas WHERE ID = ?";

    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<script>
            window.location.href = 'adminSala.php'; // Cambia esto por la página a la que quieras redirigir
          </script>";
        } else {
            echo "Error al borrar la sala: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "<script>
        alert('Error al borrar la sala: " . $stmt->error . "');
        window.location.href = 'adminSala.php'; // Cambia esto por la página a la que quieras redirigir
      </script>";
    }
} else {
    echo "<script>
            alert('No se recibió un ID válido.');
            window.location.href = 'adminSala.php'; // Cambia esto por la página a la que quieras redirigir
          </script>";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>