<?php

$conexion = new mysqli("localhost", "root", "", "jardin");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$query = "SELECT proyectos.ID, proyectos.Nombre, proyectos.Descripcion, proyectos.Imagen, salas.Salas AS SalaNombre, turnos.Turno AS TurnoNombre
          FROM proyectos
          INNER JOIN salas ON proyectos.Salas = salas.ID
          INNER JOIN turnos ON proyectos.Turno = turnos.ID
          ORDER BY proyectos.ID DESC";
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
     <!-- Enlace al favicon -->
     <link rel="icon" href="gira.ico" type="image/x-icon">
</head>
<style>
.white-container {
    max-width: 100%; 
    overflow: hidden; 
}
.custom-table-container {
    overflow-x: auto;
    max-width: 100%;
    width: 100%;
    background-color: #fff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
.custom-table-container {
    max-height: 400px;
    overflow-y: auto;
    overflow-x: auto;
    max-width: 100%;
    width: 100%;
    background-color: #fff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
.custom-table-container table {
    width: 100%;
    margin-bottom: 0;
    table-layout: auto;
    word-wrap: break-word;
}
.custom-table-container img {
    max-width: 100%;
    height: auto;
    display: block;
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
        <?php
          if ($result->num_rows > 0) {
              echo "<div class='table-responsive custom-table-container'>";
              echo "<table class='table table-bordered table-striped'>";
              echo "<thead class='thead-dark'><tr><th>Nombre</th><th>Descripción</th><th>Imagen</th><th>Sala</th><th>Turno</th><th>Acciones</th></tr></thead><tbody>";

              while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($row['Nombre']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['Descripcion']) . "</td>";
                  echo "<td><img src='" . htmlspecialchars($row['Imagen']) . "' width='100' height='100' alt='Imagen del proyecto'></td>";
                  echo "<td>" . htmlspecialchars($row['SalaNombre']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['TurnoNombre']) . "</td>";
                  echo "<td>
                          <button data-id='" . htmlspecialchars($row['ID']) . "' class='btn btn-danger btn-sm m-2'>BORRAR</button>
                          <button data-id='" . htmlspecialchars($row['ID']) . "' class='btn btn-primary btn-sm m-2' data-toggle='modal' data-target='#editModal'>EDITAR</button>
                        </td>";
                  echo "</tr>";
              }

              echo "</tbody></table>";
              echo "</div>";  // Cierra el div table-responsive
          } else {
              echo "<div class='alert alert-warning' role='alert'>No hay proyectos disponibles.</div>";
          }
      ?>

        </div>

        <div class="mt-3 mt-md-0">
        <form action="newpro.php" method="post" enctype="multipart/form-data" class="formy d-flex justify-content-center flex-column align-items-center">
    <h5 class="titleh">PROYECTOS</h5>

    <input name="Nombre" type="text" required class="form-control m-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="NOMBRE">
    <textarea name="Descripcion" type="text" required class="form-control m-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="DESCRIPCION"></textarea>
    <input name="Imagen" type="file" required class="form-control m-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="IMAGEN">

    <!-- Select dinámico para Salas -->
    <select class="form-select m-2" name="Salas" required>
            <?php
            $conexion2 = new mysqli("localhost", "root", "", "jardin");

            if ($conexion2->connect_error) {
                die("Conexión fallida: " . $conexion2->connect_error);
            }

            $sql = "SELECT ID, Salas FROM salas";
            $resultado = $conexion2->query($sql);

            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<option value='" . $fila['ID'] . "'>" . $fila['Salas'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay salas disponibles</option>";
            }

            $conexion2->close();
            ?>
        </select>

        <!-- Select para Turno -->
        <select class="form-select m-2" name="Turno" required>
            <option value="1" selected>MAÑANA</option>
            <option value="2">TARDE</option>
        </select>

        <button type="submit" class="main m-2">AÑADIR +</button>
    </form>

        </div>
    </div>

<!-- Modal -->
<div class="modal" id="editModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="h51">Editar Información del Proyecto</h5>
      </div>
      <div class="modal-body">
        <form id="editForm" enctype="multipart/form-data">
          <input type="hidden" id="editId" name="ID">
          <div class="form-group">
            <input type="text" class="form-control m-2" id="editNombre" name="Nombre" placeholder="Nombre">
          </div>
          <div class="form-group">
            <textarea class="form-control m-2" id="editDescripcion" name="Descripcion" placeholder="Descripción"></textarea>
          </div>
          <div class="form-group">
            <input type="file" class="form-control m-2" id="editImagen" name="Imagen" placeholder="Imagen">
          </div>
          <div class="form-group">
            <select class="form-select m-2" name="SalasID" id="editSalasID" required>
                    <?php
                    $conexion2 = new mysqli("localhost", "root", "", "jardin");

                    if ($conexion2->connect_error) {
                        die("Conexión fallida: " . $conexion2->connect_error);
                    }

                    $sql = "SELECT ID, Salas FROM salas";
                    $resultado = $conexion2->query($sql);

                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<option value='" . $fila['ID'] . "'>" . $fila['Salas'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay salas disponibles</option>";
                    }

                    $conexion2->close();
                    ?>
            </select>
          </div>
          <div class="form-group">
            <select id="editTurno" name="Turno" class="form-control m-2" required>
              <option value="1">Mañana</option>
              <option value="2">Tarde</option>
            </select>
          </div>
          <center>
            <button type="submit" class="btn" id="modalone">Guardar Cambios</button>
          </center>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.btn-danger').on('click', function() {
        var projectId = $(this).data('id');
        if (confirm('¿Estás seguro de que deseas borrar este proyecto?')) {
            $.ajax({
                url: 'delete_project.php', // Cambia esto si tu archivo tiene un nombre diferente
                type: 'POST',
                data: { id: projectId },
                success: function(response) {
                    alert('Proyecto borrado exitosamente.');
                    location.reload();
                },
                error: function(error) {
                    alert('Error al borrar el proyecto.');
                }
            });
        }
    });
});
$(document).ready(function() {
    $('.btn-primary').on('click', function() {
        var projectId = $(this).data('id');

        $.ajax({
            url: 'obtener_proyecto.php',
            type: 'GET',
            data: { id: projectId },
            dataType: 'json',
            success: function(response) {
                if (response) {
                    $('#editId').val(response.ID);
                    $('#editNombre').val(response.Nombre);
                    $('#editDescripcion').val(response.Descripcion);
                    $('#editTurno').val(response.Turno);

                    $.ajax({
                        url: 'obtener_salas.php',
                        type: 'GET',
                        dataType: 'json',
                        success: function(salas) {
                            $('#editSalasID').empty(); // Asegúrate de usar el ID correcto aquí
                            if (salas.length > 0) {
                                $.each(salas, function(index, sala) {
                                    $('#editSalasID').append(
                                        $('<option>').val(sala.ID).text(sala.Salas)
                                    );
                                });
                                $('#editSalasID').val(response.SalasID); // Asegúrate de que 'response.SalasID' tenga el valor correcto
                            } else {
                                $('#editSalasID').append(
                                    $('<option>').val('').text('No hay salas disponibles')
                                );
                            }
                        }
                    });

                    $('#editModal').modal('show');
                } else {
                    alert('Error al cargar los datos del proyecto.');
                }
            },
            error: function(error) {
                console.error('Error al obtener los datos del proyecto:', error);
                alert('Error al conectar con el servidor.');
            }
        });
    });

    $('#editForm').on('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: 'actualizar_proyecto.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.trim() === 'success') {
                    $('#editModal').modal('hide');
                    location.reload();
                } else {
                    alert('Error al guardar los cambios: ' + response);
                }
            },
            error: function(error) {
                console.error('Error al guardar los cambios:', error);
                alert('Error al conectar con el servidor.');
            }
        });
    });
});
</script>

</script>

</body>
</html>