<?php
$conexion = new mysqli("localhost", "root", "", "jardin");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si el campo "Nombre" está definido
    if (isset($_POST['Nombre'])) {
        $nombre = $_POST['Nombre'];
    } else {
        die("Error: El campo Nombre no está definido.");
    }

    if (isset($_FILES['PDF']) && $_FILES['PDF']['error'] === UPLOAD_ERR_OK) {
        $pdfTmpPath = $_FILES['PDF']['tmp_name'];
        $pdfName = $_FILES['PDF']['name'];
        $pdfSize = $_FILES['PDF']['size'];
        $pdfType = $_FILES['PDF']['type'];

        if ($pdfSize > 64000000) {
            die("Error: El archivo excede el tamaño máximo permitido.");
        }

        $uploadDir = 'pdf/';
        $destPath = $uploadDir . $pdfName;

        if (move_uploaded_file($pdfTmpPath, $destPath)) {
            $query = "INSERT INTO tu_tabla_pdf (Nombre, PDF_Path) VALUES ('$nombre', '$destPath')";
            if ($conexion->query($query) === TRUE) {
                echo "<script>
                        alert('PDF subido y guardado exitosamente.');
                        window.location.href = 'admision.php'; // Cambia esto por la página a la que quieras redirigir
                      </script>";
            } else {
                echo "<script>
                alert('Error: " . $stmt->error . "');
                window.location.href = 'admision.php'; // Cambia esto por la página a la que quieras redirigir
              </script>";
            }
        } else {
            echo "<script>
            alert('Error al mover el archivo subido.');
            window.location.href = 'admision.php'; // Cambia esto por la página a la que quieras redirigir
          </script>";
        }
    } else {
        echo "<script>
        alert('Error al subir el archivo. Error: " . $_FILES['PDF']['error'] . "');
        window.location.href = 'admision.php'; // Cambia esto por la página a la que quieras redirigir
      </script>";
    }
}

$conexion->close();
?>
