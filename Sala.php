<?php

$conexion = new mysqli("localhost", "root", "", "jardin");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $color = $_POST['color'];
    $hover = $_POST['hover'];
    $nombre = $_POST['Nombre'];
    $texto = $_POST['Texto'];
    $texto2 = $_POST['Texto2'];

    $imagen = $_FILES['Imagen']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($imagen);

    if (move_uploaded_file($_FILES['Imagen']['tmp_name'], $target_file)) {
        $query = "INSERT INTO salas (Salas, Color, hover, texto, imagen, texto2) 
                  VALUES ('$nombre', '$color', '$hover', '$texto', '$target_file', '$texto2')";

        if ($conexion->query($query) === TRUE) {
            echo "<script>
            alert('Nueva sala añadida con éxito.');
            window.location.href = 'adminSala.php'; // Cambia esto por la página a la que quieras redirigir
          </script>";
        } else {
            echo "<script>
            alert('Error: " . $conexion->error . "');
            window.location.href = 'adminSala.php'; // Cambia esto por la página a la que quieras redirigir
          </script>";
        }
    } else {
        echo "<script>
                alert('Error al subir la imagen.');
                window.location.href = 'adminSala.php'; // Cambia esto por la página a la que quieras redirigir
              </script>";
    }
}

$conexion->close();
?>
