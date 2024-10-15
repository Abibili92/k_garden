<?php
session_start(); // Asegúrate de que la sesión esté iniciada

$conn = new mysqli("localhost", "root", "", "jardin");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $texto = $_POST['Texto'];
    $Nombre = $_POST['Nombre'];

    $imagen_path = null;

    if (isset($_FILES['Imagen']) && $_FILES['Imagen']['error'] == 0) {
        $imagen_path = 'uploads/' . basename($_FILES['Imagen']['name']);
        if (!move_uploaded_file($_FILES['Imagen']['tmp_name'], $imagen_path)) {
            die("Error al mover la imagen.");
        }
    }

    $id_usuario = $_SESSION['id_usuario']; 
    
    $sql = "INSERT INTO `news` (Nombre, Descripcion, Imagen, ID_usuario) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
  
    $stmt->bind_param('ssss', $Nombre, $texto, $imagen_path, $id_usuario);

    if ($stmt->execute()) {
        echo "<script>
        alert('Noticia insertada exitosamente.');
        window.location.href = 'newNew.php'; // Cambia esto por la página a la que quieras redirigir
      </script>";
    } else {
        echo "<script>
                alert('Error al insertar la noticia: " . $stmt->error . "');
                window.location.href = 'newNew.php'; // Cambia esto por la página a la que quieras redirigir
              </script>";
    }

    $stmt->close();
    $conn->close();
}
?>