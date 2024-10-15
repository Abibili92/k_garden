<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conexion = new mysqli("localhost", "root", "", "jardin");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $id = intval($_POST['ID']);
    $nombre = $conexion->real_escape_string($_POST['Nombre']);
    $descripcion = $conexion->real_escape_string($_POST['Descripcion']);

    if (!empty($_FILES['Imagen']['name'])) {
        $imagen = 'uploads/' . basename($_FILES['Imagen']['name']);
        move_uploaded_file($_FILES['Imagen']['tmp_name'], $imagen);

        $query = "UPDATE news SET Nombre = '$nombre', Descripcion = '$descripcion', Imagen = '$imagen' WHERE ID = $id";
    } else {
        $query = "UPDATE news SET Nombre = '$nombre', Descripcion = '$descripcion' WHERE ID = $id";
    }

    if ($conexion->query($query) === TRUE) {
        echo "<script>
                alert('Datos incorrectos. Verifique su usuario.');
                window.location.href = 'newNew.php'; // Cambia esto por la página a la que quieras redirigir
              </script>";
    } else {
        echo "<script>
        alert('Error actualizando noticia: " . $conexion->error . "');
        window.location.href = 'newNew.php'; // Cambia esto por la página a la que quieras redirigir
      </script>";

    }

    $conexion->close();
    header("Location: newNew.php");
    exit();
}
?>
