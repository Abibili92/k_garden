<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "jardin";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
  }

  $sala_id = 6;

  $sql = "SELECT dia.Dia AS NombreDia, horarios.Inicio, horarios.Fin 
        FROM horarios
        INNER JOIN dia ON horarios.Dia = dia.ID
        WHERE horarios.Sala = 6
        ORDER BY horarios.Dia ASC";
  $result = $conn->query($sql);

  $horarios = [];
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $horarios[] = $row;
    }
  } else {
    echo "No se encontraron horarios.";
  }

  $query2 = "SELECT publicacion_id, reaccion, COUNT(*) as count FROM reacciones GROUP BY publicacion_id, reaccion";
  $result2 = $conn->query($query2);

  $reacciones = [];
  while ($row = $result2->fetch_assoc()) {
      $reacciones[$row['publicacion_id']][$row['reaccion']] = $row['count'];
  }

  $sql_sala = "SELECT * FROM salas WHERE ID = $sala_id";
  $result_sala = $conn->query($sql_sala);

  if ($result_sala->num_rows > 0) {
      $sala = $result_sala->fetch_assoc();
  } else {
      die("No se encontró la sala.");
  }

  $conn->close();
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
    <link rel="stylesheet" href="style.css">
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
</head>
<style>
.cartelT {
    background-color:<?php echo htmlspecialchars($sala['Color']); ?>; /* Rojo normal */
    color: white;
    font-family: "Questrial", sans-serif;
}

.color {
    color:<?php echo htmlspecialchars($sala['Color']); ?>; /* Rojo normal */
    font-family: "Questrial", sans-serif;
    text-decoration: underline;
}

.color2 {
    color:<?php echo htmlspecialchars($sala['Color']); ?>; /* Rojo normal */
    font-family: "Questrial", sans-serif;
}

.btnT {
    background-color: <?php echo htmlspecialchars($sala['Color']); ?>; /* Rojo normal */
    color: white;
    width: 100%;
    font-family: "Questrial", sans-serif;
    height: 40px;
    border-radius: 10px;
    border: none;
    cursor: pointer; 
}

.btnT:hover {
    background-color:<?php echo htmlspecialchars($sala['hover']); ?>; /* Rojo oscuro */
}

.table thead th {
    background-color: <?php echo htmlspecialchars($sala['Color']); ?>; /* Rojo normal */
    color: white;
    font-family: "Questrial", sans-serif;
    padding: 10px;
    border: 1px solid <?php echo htmlspecialchars($sala['Color']); ?>; /* Rojo normal */
}

.table tbody td {
    padding: 10px;
    border: 1px solid <?php echo htmlspecialchars($sala['Color']); ?>; /* Rojo normal */
    background-color: #f9f9f9; /* Gris claro para contraste */
}

.table tbody tr:nth-child(even) td {
    background-color: #ffffff;
}

.app {
    color: <?php echo htmlspecialchars($sala['Color']); ?>; /* Rojo normal */
}

.reacciones {
    background-color: white;
    color: white;
}

.reacciones:hover {
    background-color:<?php echo htmlspecialchars($sala['hover']); ?>; /* Rojo más oscuro */
    border-radius: 20px;
}

</style>
<body>

  <header class="container-fluid">
    <div class="container d-flex justify-content-between align-items-center">
        <h2 class="m-0">Jardin de infantes N°901 Constancio C Vigil</h2>
        <div>
          <a href="https://wa.me/02252520417" target="_blank"><button class="net m-0"><i class="fab fa-whatsapp"></i></button></a>
          <a href="mailto:ji901lacosta@gmail.com"><button class="net m-0"><i class="fas fa-envelope"></i></button></a>
          <a href="https://www.instagram.com/jardin901sanclemente?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank"><button class="net m-0"><i class="fab fa-instagram"></i></button></a>
        </div>
    </div>
  </header>

    <!--Buttons-->
  <header class="n2 d-flex flex-wrap align-items-center">

    <a href="index.html"><button class="btn2">PRINCIPAL</button></a>

    <div class="dropdown">
      <button class="btn2 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        SALAS
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="salasV.php">Sala Violeta</a></li>
        <li><a class="dropdown-item" href="salasA.php">Sala Amarilla</a></li>
        <li><a class="dropdown-item" href="salasN.php">Sala Naranja</a></li>
        <li><a class="dropdown-item" href="salasT.php">Sala Turquesa</a></li>
        <li><a class="dropdown-item" href="salasVer.php">Sala Verde</a></li>
        <li><a class="dropdown-item" href="salasR.php">Sala Roja</a></li>
      </ul>
    </div>

    <button class="btn2" onclick="showAlert()" class='ai'>INGRESAR</button>

  </header>

    <div class="cartelT d-flex justify-content-center">
        <img src="<?php echo htmlspecialchars($sala['imagen']); ?>" width="100px" height="100px">
        <div class="text">
            <h2 class="text-center"><?php echo htmlspecialchars($sala['Salas']); ?></h2>
            <br>
        </div>
        <img src="<?php echo htmlspecialchars($sala['imagen']); ?>" width="100px" height="100px">
    </div>

    <div class="white d-flex flex-column flex-md-row justify-content-between align-items-center">
      
      <div class="mt-3 mt-md-0">
        <div class="carter">
            <div class="card text-center-left">
                <div class="card-body">
                    <h5 class="color text-center">Proyectos</h5>

                    <div id="project-cards">
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "jardin";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                        }

                        $sql = "SELECT proyectos.ID, proyectos.Nombre, proyectos.Descripcion, proyectos.Imagen, salas.Salas AS SalaNombre, turnos.Turno AS TurnoNombre, login.NOMBRE AS TeacherName 
                        FROM proyectos 
                        INNER JOIN salas ON proyectos.Salas = salas.ID 
                        INNER JOIN turnos ON proyectos.Turno = turnos.ID 
                        INNER JOIN login ON proyectos.id_usuario = login.id 
                        WHERE proyectos.Salas = 6
                        ORDER BY proyectos.ID DESC";
                        $result = $conn->query($sql);

                        
                        if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                            $proyecto_id = $row['ID'];
                            echo '<div class="card mb-3">';
                            echo '<img src="' . $row['Imagen'] . '" class="card-img-top" width="200px" height="400px" alt="' . $row['Nombre'] . '">';
                            echo '<div class="card-body">';
                            echo '<h5 class="color">' . $row['Nombre'] . '</h5>';
                            echo '<p class="card-text">' . $row['Descripcion'] . '</p>';
                            echo '<p class="card-text"><small class="text-muted">Sala: ' . $row['SalaNombre'] . ' - Turno: ' . $row['TurnoNombre'] . ' - Maestro: ' . $row['TeacherName'] . '</small></p>';
                            echo '</div>';

                            echo '<div class="publicacion" data-id="' . $proyecto_id . '">';
                            echo '<div class="reacciones-container">';
                            echo '<button class="reacciones" data-reaccion="me_gusta"><i class="fas fa-thumbs-up app"></i></button>';
                            echo '<button class="reacciones" data-reaccion="risa"><i class="fas fa-laugh app"></i></button>';
                            echo '<p><i class="fas fa-thumbs-up app"></i> ' . ($reacciones[$proyecto_id]['me_gusta'] ?? 0) . '</p>';
                            echo '<p><i class="fas fa-laugh app"></i> ' . ($reacciones[$proyecto_id]['risa'] ?? 0) . '</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                          }
                        } else {
                              echo '<p>No hay proyectos disponibles.</p>';
                        }

                        $conn->close();
                        ?>
                    </div>
                    

                </div>
            </div>
        </div>
      </div>

        <div class="mt-3 mt-md-0">
            <div class="carter">
                <div class="card text-center-left">
                    <div class="card-body">
                        <h5 class="color"><?php echo htmlspecialchars($sala['Salas']); ?></h5>
                        <p class="card-text">
                        <?php echo htmlspecialchars($sala['texto']); ?><br><br>
                        <?php echo htmlspecialchars($sala['texto2']); ?> 
                        </p>
                        <button class="btnT">Horarios</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Modal horarios -->
<div class="modal" id="horariosModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title color">Horarios <?php echo htmlspecialchars($sala['Salas']); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Día</th>
                    <th>Hora de Inicio</th>
                    <th>Hora de Fin</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($horarios as $horario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($horario['NombreDia']); ?></td>
                        <td><?php echo htmlspecialchars($horario['Inicio']); ?></td>
                        <td><?php echo htmlspecialchars($horario['Fin']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script>
    function showAlert() {
      Swal.fire({
        title: "<strong>ADVERTENCIA</strong>",
        icon: "info",
        html: `Este apartado es solo para miembros internos del jardin`,
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: `
          Ingresar
        `,
        confirmButtonAriaLabel: "Ingresar",
        cancelButtonText: `
           Salir
        `,
        cancelButtonAriaLabel: "Salir"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'ingresar.html';
        }
      });
    }

    $(document).ready(function(){

    $(".btnT").click(function(){
      $("#horariosModal").modal('show');
    });

    $('.reacciones').on('click', function() {
        var publicacionId = $(this).closest('.publicacion').data('id');
        var reaccion = $(this).data('reaccion');

        $.ajax({
            url: 'guardar_reaccion.php',
            type: 'POST',
            data: {
                publicacion_id: publicacionId,
                reaccion: reaccion
            },
            success: function(response) {
                if (response.trim() === 'success') {
                    alert('Reacción guardada.');
                } else {
                    alert('Error al guardar la reacción: ' + response);
                }
            },
            error: function() {
                alert('Error al conectar con el servidor.');
            }
        });
    });

    });
  </script>
  <script src="script.js"></script>

</body>
</html>