<?php

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "jardin");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Lógica para manejar el formulario de actualización de sala
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sala_id = $_POST['SalasID'];
    $color = $_POST['color'];
    $texto = $_POST['Texto'];
    $texto2 = $_POST['Texto2'];
    $hover = $_POST['hover'];
    $Sala = $_POST['Nombre'];

    $imagen_path = null;

    if (isset($_FILES['Imagen']) && $_FILES['Imagen']['error'] == 0) {
        $imagen_path = 'uploads/' . basename($_FILES['Imagen']['name']);
        if (!move_uploaded_file($_FILES['Imagen']['tmp_name'], $imagen_path)) {
            die("Error al mover la imagen.");
        }
    }

    $sql = "UPDATE salas SET Color = ?, texto = ?, hover = ?, imagen = ?, Salas = ?, texto2 = ? WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssi', $color, $texto, $hover, $imagen_path, $Sala, $texto2, $sala_id);

    if ($stmt->execute()) {
        echo "<script>
        alert('Sala actualizada exitosamente.');
        window.location.href = 'adminSala.php'; // Cambia esto por la página a la que quieras redirigir
      </script>";
    } else {
        echo "<script>
        alert('Error al actualizar la sala: " . $stmt->error . "');
        window.location.href = 'adminSala.php'; // Cambia esto por la página a la que quieras redirigir
      </script>";
    }

    $stmt->close();
}

// Cerrar la conexión después de manejar el formulario
$conn->close();
?>
