<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jardin";

$sala_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql_sala = "SELECT Color, Salas, imagen, hover, texto, texto2 FROM salas WHERE ID = ?";
$stmt_sala = $conn->prepare($sql_sala);
$stmt_sala->bind_param('i', $sala_id);
$stmt_sala->execute();
$result_sala = $stmt_sala->get_result();

if ($result_sala->num_rows > 0) {
    $sala = $result_sala->fetch_assoc();
} else {
    echo "No se encontró la sala especificada.";
    exit();
}

$sql_horarios = "SELECT dia.Dia AS NombreDia, horarios.Inicio, horarios.Fin 
                 FROM horarios
                 INNER JOIN dia ON horarios.Dia = dia.ID
                 WHERE horarios.Sala = ?
                 ORDER BY horarios.Dia ASC";
$stmt_horarios = $conn->prepare($sql_horarios);
$stmt_horarios->bind_param('i', $sala_id);
$stmt_horarios->execute();
$result_horarios = $stmt_horarios->get_result();

$horarios = [];
if ($result_horarios->num_rows > 0) {
    while ($row = $result_horarios->fetch_assoc()) {
        $horarios[] = $row;
    }
} else {
    echo "No se encontraron horarios.";
}

$sql_proyectos = "SELECT proyectos.ID, proyectos.Nombre, proyectos.Descripcion, proyectos.Imagen, salas.Salas AS SalaNombre, turnos.Turno AS TurnoNombre, login.NOMBRE AS TeacherName 
                FROM proyectos 
                INNER JOIN salas ON proyectos.Salas = salas.ID 
                INNER JOIN turnos ON proyectos.Turno = turnos.ID 
                INNER JOIN login ON proyectos.id_usuario = login.id 
                WHERE proyectos.Salas = ? 
                ORDER BY proyectos.ID DESC";
$stmt_proyectos = $conn->prepare($sql_proyectos);
$stmt_proyectos->bind_param('i', $sala_id);
$stmt_proyectos->execute();
$result_proyectos = $stmt_proyectos->get_result();

$proyectos = [];
if ($result_proyectos->num_rows > 0) {
    while ($row = $result_proyectos->fetch_assoc()) {
        $proyectos[] = $row;
    }
} else {
    echo '<p>No hay proyectos disponibles para esta sala.</p>';
}

$sql_reacciones = "SELECT Publicacion_ID, 
                          SUM(CASE WHEN Reaccion = 'me_gusta' THEN 1 ELSE 0 END) AS me_gusta, 
                          SUM(CASE WHEN Reaccion = 'risa' THEN 1 ELSE 0 END) AS risa 
                   FROM reacciones 
                   WHERE Publicacion_ID IN (SELECT ID FROM proyectos WHERE Salas = ?)
                   GROUP BY Publicacion_ID";
$stmt_reacciones = $conn->prepare($sql_reacciones);
$stmt_reacciones->bind_param('i', $sala_id);
$stmt_reacciones->execute();
$result_reacciones = $stmt_reacciones->get_result();

$reacciones = [];
if ($result_reacciones->num_rows > 0) {
    while ($row = $result_reacciones->fetch_assoc()) {
        $reacciones[$row['Publicacion_ID']] = [
            'me_gusta' => $row['me_gusta'],
            'risa' => $row['risa'],
        ];
    }
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
     <!-- Enlace al favicon -->
     <link rel="icon" href="gira.ico" type="image/x-icon">
</head>
<style>
  
  .white {
    padding-top:auto;
  }
  .carter{
    font-size:19px;
    margin-top:0;
  }
   .cartelA{
        background-color: <?php echo htmlspecialchars($sala['Color']); ?>;
        color:white;
        font-family:"Questrial", sans-serif;
   }
  .yellow{
    color:<?php echo htmlspecialchars($sala['Color']); ?>;
    font-family:"Questrial", sans-serif;
    text-decoration: underline;
  }
  .yellow2{
    color:<?php echo htmlspecialchars($sala['Color']); ?>;
    font-family:"Questrial", sans-serif;
  }
  .btnA{
    background-color:<?php echo htmlspecialchars($sala['Color']); ?>;
    color:white;
    width:100%;
    font-family:"Questrial", sans-serif;
    height:40px;
    border-radius:10px;
  }
  .btnA:hover{
    background-color:<?php echo htmlspecialchars($sala['hover']); ?>;
  }
  .table thead th {
    background-color: <?php echo htmlspecialchars($sala['Color']); ?>;
    color: #fff;
    font-family:"Questrial", sans-serif;
    padding: 10px;
    border: 1px solid <?php echo htmlspecialchars($sala['Color']); ?>;
  }
  .table tbody td {
    padding: 10px;
    border: 1px solid <?php echo htmlspecialchars($sala['Color']); ?>;
    background-color:#dfdfdf;
  }
  .table tbody tr:nth-child(even) td {
    background-color:#ffffff;
  }
  .app{
    color:<?php echo htmlspecialchars($sala['Color']); ?>;
  }
  .reacciones{
      background-color:white;
      color:white;
    }
    .reacciones:hover{
      background-color:<?php echo htmlspecialchars($sala['hover']); ?>;
      border-radius:20px;
    }

  .carter{
    
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
    <a href="index.php"><button class="btn2">PRINCIPAL</button></a>

    <?php
    $conexion2 = new mysqli("localhost", "root", "", "jardin");

    if ($conexion2->connect_error) {
        die("Conexión fallida: " . $conexion2->connect_error);
    }

    $sql = "SELECT ID, Salas FROM salas";
    $resultado = $conexion2->query($sql);
    ?>

<div class="dropdown">
    <button class="btn2 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        SALAS
    </button>
    <ul class="dropdown-menu">
        <?php
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<li><a class='dropdown-item' href='salas.php?id=" . $fila['ID'] . "'>" . $fila['Salas'] . "</a></li>";
            }
        } else {
            echo "<li><a class='dropdown-item' href='#'>No hay salas disponibles</a></li>";
        }
        ?>
    </ul>
</div>

<?php
$conexion2->close();
?>

    <button class="btn2" onclick="showAlert()"  class='ai'>INGRESAR</button>
  </header>

    <div class="cartelA d-flex justify-content-center">
        <img src="<?php echo htmlspecialchars($sala['imagen']); ?>" width="100px" height="100px">
        <div class="text">
            <h2 class="text-center"><?php echo htmlspecialchars($sala['Salas']); ?></h2>
            <br>
        </div>
        <img src="<?php echo htmlspecialchars($sala['imagen']); ?>" width="100px" height="100px">
    </div>

    <div class="white d-flex flex-column flex-md-row justify-content-between align-items-start">
      
    <div class="mt-3 mt-md-0">
    <div class="carter">
        <div class="card text-center-left">
            <div class="card-body">
                <h5 class="yellow text-center">Proyectos</h5>

                <div id="project-cards">
                      <?php
                    if (!empty($proyectos)) {
                        foreach ($proyectos as $row) {
                            $proyecto_id = $row['ID'];
                            echo '<div class="card mb-3">';
                            echo '<img src="' . htmlspecialchars($row['Imagen']) . '" class="card-img-top" width="200px" height="400px" alt="' . htmlspecialchars($row['Nombre']) . '">';
                            echo '<div class="card-body">';
                            echo '<h5 class="yellow">' . htmlspecialchars($row['Nombre']) . '</h5>';
                            echo '<p class="card-text">' . htmlspecialchars($row['Descripcion']) . '</p>';
                            echo '<p class="card-text"><small class="text-muted">' . htmlspecialchars($row['SalaNombre']) . ' - Turno: ' . htmlspecialchars($row['TurnoNombre']) . ' - Maestro: ' . htmlspecialchars($row['TeacherName']) . '</small></p>';
                            echo '</div>';

                            echo '<div class="publicacion" data-id="' . $proyecto_id . '">';
                            echo '<div class="reacciones-container">';
                            echo '<button class="reacciones" data-reaccion="me_gusta"><i class="fas fa-thumbs-up app"></i></button>';
                            echo '<button class="reacciones" data-reaccion="risa"><i class="fas fa-laugh app"></i></button>';
                            echo '<p><i class="fas fa-thumbs-up app"></i> ' . htmlspecialchars($reacciones[$proyecto_id]['me_gusta'] ?? 0) . '</p>';
                            echo '<p><i class="fas fa-laugh app"></i> ' . htmlspecialchars($reacciones[$proyecto_id]['risa'] ?? 0) . '</p>';
                            echo '</div>';
                            echo '</div>';

                            echo '</div>';
                        }
                    } else {
                        echo '<p>No hay proyectos disponibles.</p>';
                    }
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
                        <h5 class="yellow"><?php echo htmlspecialchars($sala['Salas']); ?></h5>
                        <p class="card-text">
                        <?php echo htmlspecialchars($sala['texto']); ?><br><br>
                        <?php echo htmlspecialchars($sala['texto2']); ?>  
                        </p>
                        <button class="btnA">Horarios</button>
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
        <h5 class="modal-title yellow">Horarios <?php echo htmlspecialchars($sala['Salas']); ?></h5>
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

    $(".btnA").click(function(){
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