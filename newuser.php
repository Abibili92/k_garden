<?php

$conexion = new mysqli("localhost", "root", "", "jardin");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$query = "SELECT login.id, login.DNI, login.NOMBRE, rol.ROL AS nombre_rol
          FROM login
          JOIN rol ON login.ROL = rol.ID";
$result = $conexion->query($query);

$query2 = "SELECT horarios.id, horarios.Dia, horarios.Inicio, horarios.Fin, salas.Salas AS Sala, dia.Dia AS NombreDia
           FROM horarios 
           INNER JOIN salas ON horarios.Sala = salas.ID
           INNER JOIN dia ON horarios.Dia = dia.ID";
$result2 = $conexion->query($query2);

$conexion->close();

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
    max-height: 400px;
    overflow-y: auto;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 10px;
}

.table-responsive {
    width: 100%; /* Asegura que la tabla use todo el ancho disponible */
    overflow-x: auto; /* Habilita la barra de desplazamiento horizontal */
    -webkit-overflow-scrolling: touch; /* Agrega un desplazamiento suave en dispositivos táctiles */
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

<div class="white">
<!-- FIRST DIV -->
<div class="container d-flex flex-column flex-md-row justify-content-between align-items-center my-4 p-0">
  <div class="table-container">
    <div class="table-responsive w-100 ms-auto m-4"> <!-- Empuja la tabla hacia la derecha -->
        <?php if ($result->num_rows > 0): ?>
            <table class='table table-bordered table-striped'>
                <thead class='thead-dark'>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['DNI']) ?></td>
                            <td><?= htmlspecialchars($row['NOMBRE']) ?></td>
                            <td><?= htmlspecialchars($row['nombre_rol']) ?></td>
                            <td>
                                <button data-id='<?= htmlspecialchars($row['id']) ?>' class='btn btn-danger sch2 btn-sm m-2'>BORRAR</button>
                                <button data-id='<?= htmlspecialchars($row['id']) ?>' class='btn btn-primary ed2 btn-sm m-2' data-toggle='modal' data-target='#editModal'>EDITAR</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class='alert alert-warning' role='alert'>No hay usuarios registrados.</div>
        <?php endif; ?>
    </div>
  </div>

  
<!-- SECOND DIV -->
<form action="newusu.php" method="post" class="formy d-flex justify-content-center flex-column align-items-center my-4 w-100">
    <h5 class="titleh mb-auto">USUARIOS</h5> <!-- Empuja el título hacia arriba -->
    <input name="DNI" type="text" required class="form-control mt-2 w-100" placeholder="DNI"> <!-- Añade margen superior -->
    <input name="Nombre" type="text" required class="form-control mt-2 w-100" placeholder="NOMBRE"> <!-- Añade margen superior -->
    <input name="Password" type="password" required class="form-control mt-2 w-100" placeholder="CONTRASEÑA"> <!-- Añade margen superior -->
    <select class="form-select mt-2 w-100" name="select" required>
        <option value="1" selected>MAESTRO</option>
        <option value="2">DIRECTIVO</option>
        <option value="3">EOE</option>
        <option value="4">SECRETARIO</option>
        <option value="5">OTRO</option>
    </select>
    <button type="submit" class="btn2 mt-4">AÑADIR +</button> <!-- Aumenta el margen superior del botón -->
</form>

</div>

<!-- PHP SHOW SALAS HORARIOS -->

    <!-- THIRD DIV -->
<div class="container d-flex flex-column flex-md-row justify-content-between align-items-center m-8">
<form action="horarios.php" method="post" class="formy d-flex justify-content-center flex-column align-items-center m-3 w-100 p-5">
    <h5 class="titleh">HORARIOS</h5>

    <div class="d-flex flex-column w-100">
        <select class="form-select m-2 flex-fill" name="Dia" required>
            <option value="1" selected>LUNES</option>
            <option value="2">MARTES</option>
            <option value="3">MIERCOLES</option>
            <option value="4">JUEVES</option>
            <option value="5">VIERNES</option>
        </select>
        <input name="Inicio" type="text" required class="form-control m-2 flex-fill" placeholder="HORA - INICIO">
        <input name="Fin" type="text" required class="form-control m-2 flex-fill" placeholder="HORA - FIN">

        <select class="form-select m-2 flex-fill" name="SalaID" required>
            <?php 
            $conexion2 = new mysqli("localhost", "root", "", "jardin");

            if ($conexion2->connect_error) {
                die("Conexión fallida: " . $conexion->connect_error);
            }
            
            $query_salas = "SELECT ID, Salas FROM salas";
            $resultado_salas = $conexion2->query($query_salas);
            

            if ($resultado_salas->num_rows > 0) {
                while($fila_sala = $resultado_salas->fetch_assoc()) {
                    echo '<option value="' . $fila_sala['ID'] . '">' . $fila_sala['Salas'] . '</option>';
                }
            } else {
                echo '<option value="">No hay salas disponibles</option>';
            }

            $conexion2->close();
            ?>
        </select>
    </div>

    <button type="submit" class="btn2 m-2">AÑADIR +</button>
</form>

<div class="table-container">
    <!-- Agrandamos la tabla -->
    <div class="table-responsive w-100">
        <?php if ($result2->num_rows > 0): ?>
            <table class='table table-bordered table-striped'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Día</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Sala</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result2->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['NombreDia']) ?></td> <!-- Cambiado para mostrar el nombre del día -->
                            <td><?= htmlspecialchars($row['Inicio']) ?></td>
                            <td><?= htmlspecialchars($row['Fin']) ?></td>
                            <td><?= htmlspecialchars($row['Sala']) ?></td>
                            <td>
                                <button data-id='<?= htmlspecialchars($row['id']) ?>' class='btn btn-danger sch btn-sm m-2'>BORRAR</button>
                                <button data-id='<?= htmlspecialchars($row['id']) ?>' class='btn btn-primary btn-sm m-2' data-bs-toggle='modal' data-bs-target='#editModalII'>EDITAR</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class='alert alert-warning' role='alert'>No hay horarios registrados.</div>
        <?php endif; ?>
    </div>
</div>

</div>

</div>

<!-- Modal -->
<div class="modal" id="editModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="h51">Editar Información del Usuario</h5>
      </div>
      <div class="modal-body">
        <form id="editForm">
          <input type="hidden" id="editId" name="ID">
          <div class="form-group">
            <input type="text" class="form-control m-2" id="editDNI" name="DNI" placeholder="DNI">
          </div>
          <div class="form-group">
            <input type="text" class="form-control m-2" id="editNombre" name="Nombre" placeholder="NOMBRE"> </div>
          <div class="form-group">
            <input type="password" class="form-control m-2" id="editPassword" name="Password" placeholder="CONTRASEÑA"> </div>
          <div class="form-group">
            <select id="editROL" name="ROL" placeholder="ROL" class="form-control m-2" required>
              <option value="1">Maestro</option>
              <option value="2">Directivo</option>
              <option value="3">EOE</option>
              <option value="4">Secretario</option>
              <option value="5">Otro</option>
            </select>
          </div>
          <center>
          <button type="submit" class="btn" id="modalone">Guardar Cambios</button>
          </center>
        </form>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal horario -->
<div class="modal fade" id="editModalII" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="editModalLabel" class="h51">Editar Horarios de Sala</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editHorarioForm" action="actualizar_horario.php" method="post">
          <input type="hidden" id="editid" name="id">
          
          <div class="form-group">
            <input name="Inicio" type="text" required class="form-control m-2 flex-fill" id="editInicio" placeholder="HORA - INICIO">
          </div>
          
          <div class="form-group">
            <input name="Fin" type="text" required class="form-control m-2 flex-fill" id="editFin" placeholder="HORA - FIN">
          </div>
          
          <div class="form-group">
            <select class="form-select m-2" name="Dia" id="editDay" required>
              <option value="1">LUNES</option>
              <option value="2">MARTES</option>
              <option value="3">MIERCOLES</option>
              <option value="4">JUEVES</option>
              <option value="5">VIERNES</option>
            </select>
          </div>
          
          <div class="form-group">
            <select class="form-select m-2" name="SalaID" id="editRoom" required>
              <?php
              // Conexión a la base de datos
              $conexion = new mysqli("localhost", "root", "", "jardin");
              if ($conexion->connect_error) {
                  die("Conexión fallida: " . $conexion->connect_error);
              }

              $query_salas = "SELECT ID, Salas FROM salas";
              $resultado_salas = $conexion->query($query_salas);
              if ($resultado_salas->num_rows > 0) {
                  while ($fila_sala = $resultado_salas->fetch_assoc()) {
                      echo '<option value="' . htmlspecialchars($fila_sala['ID']) . '">' . htmlspecialchars($fila_sala['Salas']) . '</option>';
                  }
              } else {
                  echo '<option value="">No hay salas disponibles</option>';
              }
              $conexion->close();
              ?>
            </select>
          </div>
          <center>
            <button type="submit" class="btn" id="modalone">Guardar Cambios</button>
          </center>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Delete User
    $('.sch2').on('click', function() {
        var userId = $(this).data('id');
        $.ajax({
            url: 'delete_user.php',
            type: 'POST',
            data: { id: userId },
            success: function(response) {
                alert('Usuario borrado exitosamente.');
                location.reload();
            },
            error: function(error) {
                alert('Error al borrar el usuario.');
            }
        });
    });

    // Edit User
    document.querySelectorAll('.ed2').forEach(button => {
        button.addEventListener('click', async function() {
            const userId = this.getAttribute('data-id');
            try {
                const response = await fetch(`obtener_usuario.php?id=${userId}`);
                const userData = await response.json();
                
                if (userData) {
                    document.getElementById('editId').value = userId;
                    document.getElementById('editDNI').value = userData.DNI || '';
                    document.getElementById('editNombre').value = userData.NOMBRE || '';
                    document.getElementById('editPassword').value = userData.CONTRASEÑA || '';
                    document.getElementById('editROL').value = userData.ROL || '1';
                } else {
                    alert('Error al cargar los datos del usuario.');
                }

                $('#editModal').modal('show');
            } catch (error) {
                console.error('Error al obtener los datos del usuario:', error);
                alert('Error al conectar con el servidor.');
            }
        });
    });

    // Update User
    document.getElementById('editForm').addEventListener('submit', async function(event) {
        event.preventDefault();

        const formData = {
            ID: document.getElementById('editId').value,
            DNI: document.getElementById('editDNI').value,
            Nombre: document.getElementById('editNombre').value,
            Password: document.getElementById('editPassword').value,
            ROL: document.getElementById('editROL').value
        };

        try {
            const response = await fetch('actualizar.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            });

            const data = await response.text();
            console.log('Respuesta del servidor:', data);

            if (data.trim() === 'success') {
                $('#editModal').modal('hide');
                location.reload();
            } else {
                alert('Error al guardar los cambios: ' + data);
            }
        } catch (error) {
            console.error('Error al guardar los cambios:', error);
            alert('Error al conectar con el servidor.');
        }
    });

    // Delete Timetable
    $('.sch').on('click', function() {
        var timetableId = $(this).data('id');
        if(confirm('¿Está seguro de que desea eliminar este horario?')) {
            $.ajax({
                url: 'delete_schedule.php',
                type: 'POST',
                data: { id: timetableId },
                success: function(response) {
                    alert('Horario borrado exitosamente.');
                    location.reload();
                },
                error: function(error) {
                    alert('Error al borrar el horario.');
                }
            });
        }
      });

});
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('button[data-bs-target="#editModalII"]');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const row = this.closest('tr');
            const inicio = row.children[1].textContent.trim();
            const fin = row.children[2].textContent.trim();
            const dia = row.children[0].getAttribute('data-day-id');  // Verifica que este atributo esté presente y tenga el valor correcto
            const sala = row.children[3].getAttribute('data-room-id');  // Verifica que este atributo esté presente y tenga el valor correcto

            // Imprime los valores para depuración
            console.log('ID:', id);
            console.log('Inicio:', inicio);
            console.log('Fin:', fin);
            console.log('Día:', dia);
            console.log('Sala:', sala);

            // Asigna los valores a los campos del modal
            document.querySelector('#editid').value = id;
            document.querySelector('#editInicio').value = inicio;
            document.querySelector('#editFin').value = fin;

            // Selecciona la opción correcta en el <select> de días
            const editDaySelect = document.querySelector('#editDay');
            if (editDaySelect) {
                editDaySelect.value = dia;
                console.log('Selected Day:', editDaySelect.value);
            }

            // Selecciona la opción correcta en el <select> de salas
            const editRoomSelect = document.querySelector('#editRoom');
            if (editRoomSelect) {
                editRoomSelect.value = sala;
                console.log('Selected Room:', editRoomSelect.value);
            }
        });
    });
});

</script>

</body>
</html>