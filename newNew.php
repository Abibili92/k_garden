<?php

$conexion = new mysqli("localhost", "root", "", "jardin");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta para proyectos
$query = "SELECT proyectos.ID, proyectos.Nombre, proyectos.Descripcion, proyectos.Imagen, salas.Salas AS SalaNombre, turnos.Turno AS TurnoNombre
          FROM proyectos
          INNER JOIN salas ON proyectos.Salas = salas.ID
          INNER JOIN turnos ON proyectos.Turno = turnos.ID
          ORDER BY proyectos.ID DESC";
$result = $conexion->query($query);

// Consulta para noticias con INNER JOIN para obtener el nombre del usuario
$query2 = "SELECT news.ID, news.Nombre, news.Descripcion, news.Imagen, login.NOMBRE AS UsuarioNombre 
           FROM news 
           INNER JOIN login ON news.ID_usuario = login.id 
           ORDER BY news.ID DESC";
$result2 = $conexion->query($query2);

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
.white-container {
    max-width: 100%; 
    overflow: hidden; 
}

.custom-table-container {
    max-height: 400px;
    max-width: 100%;
    width: 100%;
    background-color: #fff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    overflow-x: auto;
    overflow-y: auto;
}

.another-container {
    max-height: 300px; /* Especifica el alto máximo antes de mostrar el scroll */
    max-width: 500px;  /* Especifica el ancho máximo antes de mostrar el scroll */
    overflow-x: auto;  /* Muestra la barra horizontal cuando sea necesario */
    overflow-y: auto;  /* Muestra la barra vertical cuando sea necesario */
    background-color: #f0f0f0;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Asegúrate de que los elementos internos se ajusten correctamente */
.another-container div {
    width: 100%; /* Se ajusta al ancho completo del contenedor */
    height: auto;
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
         <div class="white-container w-100 m-4">
    <div class="custom-table-container">
        <?php
        if ($result2->num_rows > 0) {
            echo "<table class='table table-bordered table-striped'>";
            echo "<thead class='thead-dark'><tr><th>Nombre</th><th>Descripción</th><th>Imagen</th><th>Usuario</th><th>Acciones</th></tr></thead><tbody>";

            while ($row = $result2->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['Nombre']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Descripcion']) . "</td>";
                echo "<td><img src='" . htmlspecialchars($row['Imagen']) . "' width='100' height='100' alt='Imagen de la noticia'></td>";
                echo "<td>" . htmlspecialchars($row['UsuarioNombre']) . "</td>";
                echo "<td>
                    <form method='POST' action='delete_news.php'>
                            <input type='hidden' name='id' value='" . htmlspecialchars($row['ID']) . "'>
                            <button type='submit' class='btn btn-danger btn-sm m-2'>BORRAR</button>
                        </form>
                        <button data-id='" . htmlspecialchars($row['ID']) . "' class='btn btn-primary btn-sm m-2 editBtn' data-bs-toggle='modal' data-bs-target='#editModal'>EDITAR</button>
                    </td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-warning' role='alert'>No hay noticias disponibles.</div>";
        }
        ?>
    </div>
</div>

        <div class="mt-3 mt-md-0">
            <form action="NEWS.php" method="post" enctype="multipart/form-data" class="formy d-flex justify-content-center flex-column align-items-center">
            <h5 class="titleh">NOTICIAS</h5>

             <input name="Nombre" type="text" required class="form-control m-2" aria-describedby="emailHelp" placeholder="NOMBRE">
             <textarea name="Texto" type="text" required  class="form-control m-2" aria-describedby="emailHelp" placeholder="DESCRIPCION"></textarea>
             <input name="Imagen" type="file" required class="form-control m-2"  aria-describedby="emailHelp" placeholder="IMAGEN">

            <button type="submit" class="main m-2">AÑADIR +</button>
            </form>
        </div>

    </div>


<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Noticia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" action="update_news.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="ID" id="editID">
          <div class="mb-3">
            <label for="editNombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="editNombre" name="Nombre" required>
          </div>
          <div class="mb-3">
            <label for="editDescripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="editDescripcion" name="Descripcion" required></textarea>
          </div>
          <div class="mb-3">
            <label for="editImagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="editImagen" name="Imagen">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const editBtns = document.querySelectorAll(".editBtn");

    editBtns.forEach(button => {
        button.addEventListener("click", function () {
            const noticiaID = this.getAttribute("data-id");
            fetch(`get_news.php?id=${noticiaID}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("editID").value = data.ID;
                    document.getElementById("editNombre").value = data.Nombre;
                    document.getElementById("editDescripcion").value = data.Descripcion;
                })
                .catch(error => console.error('Error fetching the news data:', error));
        });
    });
});
</script>

</body>
</html>