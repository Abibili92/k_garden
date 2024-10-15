<?php
session_start();

$conexion = mysqli_connect("localhost", "root", "", "jardin");

if (!$conexion) {
    echo "<script>
            alert('Conexión fallida: " . mysqli_connect_error() . "');
            window.location.href = 'pagina_de_redireccion.php'; // Cambia esto por la página a la que quieras redirigir
          </script>";
    exit();
}

if (isset($_POST['Nombre']) && isset($_POST['Descripcion']) && isset($_FILES['Imagen']) && isset($_POST['Salas']) && isset($_POST['Turno'])) {
    $Nombre = mysqli_real_escape_string($conexion, $_POST['Nombre']);
    $Descripcion = mysqli_real_escape_string($conexion, $_POST['Descripcion']);
    $Salas = mysqli_real_escape_string($conexion, $_POST['Salas']);
    $Turno = mysqli_real_escape_string($conexion, $_POST['Turno']);

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["Imagen"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["Imagen"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<script>
                alert('El archivo no es una imagen.');
                window.location.href = 'newproyect.php'; // Cambia esto por la página a la que quieras redirigir
              </script>";
        $uploadOk = 0;
        exit();
    }

    if (file_exists($target_file)) {
        echo "<script>
                alert('Lo siento, el archivo ya existe.');
                window.location.href = 'newproyect.php'; // Cambia esto por la página a la que quieras redirigir
              </script>";
        $uploadOk = 0;
        exit();
    }

    if ($_FILES["Imagen"]["size"] > 500000) { // 500KB
        echo "<script>
                alert('Lo siento, tu archivo es demasiado grande.');
                window.location.href = 'newproyect.php'; // Cambia esto por la página a la que quieras redirigir
              </script>";
        $uploadOk = 0;
        exit();
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "<script>
                alert('Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.');
                window.location.href = 'newproyect.php'; // Cambia esto por la página a la que quieras redirigir
              </script>";
        $uploadOk = 0;
        exit();
    }

    if ($uploadOk == 0) {
        echo "<script>
                alert('Lo siento, tu archivo no fue subido.');
                window.location.href = 'newproyect.php'; // Cambia esto por la página a la que quieras redirigir
              </script>";
        exit();
    } else {
        if (move_uploaded_file($_FILES["Imagen"]["tmp_name"], $target_file)) {
            $id_usuario = $_SESSION['id_usuario'];

            $query = "INSERT INTO `proyectos`(`Salas`, `Nombre`, `Descripcion`, `Imagen`, `Turno`, `id_usuario`)
                      VALUES ('$Salas', '$Nombre', '$Descripcion', '$target_file', '$Turno', '$id_usuario')";

            if (mysqli_query($conexion, $query)) {
                echo "<script>
                        alert('Datos insertados correctamente.');
                        window.location.href = 'newproyect.php'; // Cambia esto por la página a la que quieras redirigir
                      </script>";
            } else {
                echo "<script>
                        alert('Error: " . mysqli_error($conexion) . "');
                        window.location.href = 'newproyect.php'; // Cambia esto por la página a la que quieras redirigir
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Lo siento, hubo un error al subir tu archivo.');
                    window.location.href = 'newproyect.php'; // Cambia esto por la página a la que quieras redirigir
                  </script>";
        }
    }
} else {
    echo "<script>
            alert('Faltan datos en el formulario.');
            window.location.href = 'newproyect.php'; // Cambia esto por la página a la que quieras redirigir
          </script>";
}

mysqli_close($conexion);
?>
