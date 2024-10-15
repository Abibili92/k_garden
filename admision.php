<?php

$conexion = new mysqli("localhost", "root", "", "jardin");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$query_pdfs = "SELECT ID, Nombre, PDF_Path FROM tu_tabla_pdf ORDER BY ID DESC";
$result_pdfs = $conexion->query($query_pdfs);

$conexion->close();

?>
<?php
  include 'config_cookies.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!--Metadatos-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Titulo-->
    <title>JARDIN CONSTANCIO C VIGIL N901</title>
    <!--Links-->
    <link rel="stylesheet" href="newusu.css">
    <!--FONTS AWESOME-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <!--FAS FA-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!--Sweet Alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <!-- Enlace al favicon -->
     <link rel="icon" href="gira.ico" type="image/x-icon">
</head>
<style>
    .table-container {
    max-height: 500px;
    overflow-y: auto;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 10px;
}
</style>
<body>

  <!--Buttons-->
  <header class="n2">
  <?php
    session_start();

    if (isset($_SESSION['rol_usuario'])) {
        $rol_usuario = $_SESSION['rol_usuario'];
      
        $roles_sin_acceso = array("1", "3", "5");

        if (in_array($rol_usuario, $roles_sin_acceso)) {
            echo '<button class="btn2" disabled>NUEVO USUARIO +</button>';
        } else {
            echo '<a href="newuser.php"><button class="btn2">NUEVO USUARIO +</button></a>';
        }
    } else {
        echo 'No se ha iniciado sesión correctamente.';
    }
  ?>
    <a href="newproyect.php"><button class="btn2">NUEVO PROYECTO +</button></a>
    <a href="newNew.php"><button class="btn2">NUEVA NOTICIA +</button></a>
    <a href="adminSala.php"><button class="btn2">SALA +</button></a>
    <a href="admision.php"><button class="btn2">CONTINUIDAD PEDAGOGICA</button></a>
    <a href="cerrar_sesion.php" class="ai"><button class="btn2">CERRAR SESIÓN</button></a>
  </header>

    <div class="white d-flex flex-column flex-md-row justify-content-between align-items-center">
         <!--FIRST DIV-->
        <div class="container">
         <h5 class="titleh">PDFs Disponibles</h5>
            <div class="table-container">
                <?php
                    if ($result_pdfs->num_rows > 0) {
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead class='thead-dark'><tr><th>Nombre</th><th>PDF</th><th>Acciones</th></tr></thead><tbody>";
                        while ($row = $result_pdfs->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['Nombre']) . "</td>";
                            echo "<td><a href='" . htmlspecialchars($row['PDF_Path']) . "' target='_blank'>Ver PDF</a></td>";
                            echo "<td>
                                <form method='POST' action='delete_pdf.php'>
                                    <input type='hidden' name='id' value='" . htmlspecialchars($row['ID']) . "'>
                                    <button type='submit' class='btn btn-danger btn-sm m-2'>BORRAR</button>
                                </form>
                            </td>";
                            echo "</tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "<div class='alert alert-warning' role='alert'>No hay PDFs disponibles.</div>";
                    }
                ?>
            </div>
        </div>
        
        <div class="mt-3 mt-md-0">
            <form action="PDF.php" method="post" enctype="multipart/form-data" class="formy d-flex justify-content-center flex-column align-items-center">
                <h5 class="titleh">AGREGAR PDF</h5>

                <input name="Nombre" type="text" required class="form-control m-2" placeholder="NOMBRE">
                <input name="PDF" type="file" required class="form-control m-2" accept="application/pdf" placeholder="ARCHIVO">

                <button type="submit" class="main m-2">AÑADIR +</button>
            </form>
        </div>
</div>


</body>
</html>