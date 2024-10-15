<?php
$conexion = new mysqli("localhost", "root", "", "jardin");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta para obtener datos de la tabla `salas`
$query = "SELECT ID, Salas, Color, texto, imagen, hover, texto2 FROM salas";
$result = $conexion->query($query);

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
.colorss{
  width:100%;
  COLOR:WHITE;
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
        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered table-striped table-responsive'>";
            echo "<thead class='thead-dark'><tr><th>Sala</th><th>Color</th><th>Texto</th><th>Imagen</th><th>Hover</th><th>Texto 2</th><th>Acciones</th></tr></thead><tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['Salas']) . "</td>";
                
                // Mostrar el color como un cuadro de color
                echo "<td><div style='width: 50px; height: 50px; background-color: " . htmlspecialchars($row['Color']) . ";'></div></td>";

                echo "<td>". htmlspecialchars($row['texto']) . "</td>";
                
                // Mostrar la imagen de la sala
                echo "<td><img src='" . htmlspecialchars($row['imagen']) . "' width='100' height='100' alt='Imagen de la sala'></td>";
                
                // Aplicar hover al texto con CSS inline (debe cambiar el color al hacer hover)
                echo "<td><div style='width: 50px; height: 50px; background-color: ".htmlspecialchars($row['hover']).";'></div></td>";
                
                echo "<td>" . htmlspecialchars($row['texto2']) . "</td>";
                
                echo "<td>
                        <form action='deleteSala.php' method='post' style='display:inline;'>
                            <input type='hidden' name='ID' value='" . htmlspecialchars($row['ID']) . "'>
                            <button type='submit' class='btn btn-danger btn-sm m-2'>BORRAR</button>
                        </form>
                      </td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-warning' role='alert'>No hay salas disponibles.</div>";
        }
        ?>
    </div>
</div>
        <div class="mt-3 mt-md-0">
        <form action="newSala.php" method="post" enctype="multipart/form-data" class="formy d-flex justify-content-center flex-column align-items-center ">
    <h5 class="titleh">SALAS</h5>

    <select class="form-select m-2" name="SalasID" required>
        <?php
        $conexion2 = new mysqli("localhost", "root", "", "jardin");

        if ($conexion2->connect_error) {
            die("Conexión fallida: " . $conexion2->connect_error);
        }

        $sql = "SELECT ID, Salas FROM salas";
        $resultado = $conexion2->query($sql);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<option value='" . $fila['ID'] . "'>" . htmlspecialchars($fila['Salas']) . "</option>";
            }
        } else {
            echo "<option value=''>No hay salas disponibles</option>";
        }

        $conexion2->close();
        ?>
    </select>

    <!-- Campo para seleccionar el color principal de la sala -->
    <div class="form-group m-2 colorss">
        <label for="color" class="form-label">Color Principal:</label>
        <input type="color" id="color" name="color" value="#000000" class="form-control">
    </div>

    <div class="form-group m-2 colorss">
        <label for="hover" class="form-label">Color Hover:</label>
        <input type="color" id="hover" name="hover" value="#000000" class="form-control">
    </div>

    <input name="Nombre" type="text" required class="form-control m-2" placeholder="NOMBRE">
    <textarea name="Texto" type="text" required class="form-control m-2" placeholder="DESCRIPCIÓN"></textarea>
    <textarea name="Texto2" type="text" required class="form-control m-2" placeholder="DESCRIPCIÓN 2"></textarea>
    <input name="Imagen" type="file" required class="form-control m-2" placeholder="IMAGEN">

    <button type="submit" class="main m-2">ACTUALIZAR +</button>
</form>
            <center>
                <button class="main m-2" data-bs-toggle="modal" data-bs-target="#addSalaModal">AÑADIR SALA +</button>
            </center>
        </div>

    </div>
 
    <!-- Modal -->
    <div class="modal fade" id="addSalaModal" tabindex="-1" aria-labelledby="addSalaModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addSalaModalLabel">Añadir Nueva Sala</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="Sala.php" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="salaNombre" class="form-label">Nombre de la Sala</label>
                <input type="text" class="form-control" id="salaNombre" name="Nombre" required>
              </div>
              <div class="mb-3">
                <label for="salaColor" class="form-label">Color</label>
                <input type="color" class="form-control" id="salaColor" name="color" value="#000000" required>
              </div>
              <div class="mb-3">
                <label for="salaHover" class="form-label">Hover</label>
                <input type="color" class="form-control" id="salaHover" name="hover" value="#000000" required>
              </div>
              <div class="mb-3">
                <label for="salaTexto" class="form-label">Descripción</label>
                <textarea class="form-control" id="salaTexto" name="Texto" rows="3" required></textarea>
              </div>
              <div class="mb-3">
                <label for="salaTexto2" class="form-label">Descripción 2</label>
                <textarea class="form-control" id="salaTexto2" name="Texto2" rows="3" required></textarea>
              </div>
              <div class="mb-3">
                <label for="salaImagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="salaImagen" name="Imagen" required>
              </div>
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
</body>
</html>