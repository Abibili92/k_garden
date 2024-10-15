<?php
$conexion = new mysqli("localhost", "root", "", "jardin");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$sql = "SELECT * FROM `news` ";
$resultado2 = $conexion->query($sql);

if (!$resultado2) {
    die("Error en la consulta: " . $conexion->error);
}
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
  *{
    font-family:'Questrial';
  }

    .card3 {
    width: 100;
    margin-bottom: 20px;
    background-color: white; 
    border: 10px solid #ffd552; 
    color: black;
    padding:5px;
  }

  @media (max-width: 768px) {
    .white {
      flex-direction: column; 
    }
    .carter, .notify {
      width: 100%;
    }
  }

  .notify {
    margin-top:10px;
    max-width:1000px;
    max-height: 900px; 
    overflow-y: auto;
    padding: 10px;
  }
</style>

<body>

<!--Header-->
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

<!--Contents-->
  
<div class="cartel d-flex justify-content-between">

<div class="text">
  <h2 class="text-center">¡Bienvenidos a nuestro jardin!</h2>
  <br>
  <h4>Gracias por visitar nuestro sitio web oficial.<br>En el, encontraras nuestras propuestas educativas, nuestra actividad y dedicacion para con nuestros pequeños alumnitos.<br>Podras encontrar un apartado para visualizar la actividad por sala, estar al tanto de las novedades mas recientes del establecimiento o hechar un vistazo de las actividades con lo que respecta al jardin en si.<br>
  Tambien podras visualizar nuestras redes sociales junto con horarios e informacion sobre admisiones.
  </h4>
</div>

<img src="img/R.jpg" id="image" class="kids" width="400px">
</div>

<div class="white d-flex justify-content-between align-items-start">

<!--1ST DIV-->
<div class="carter">
  <div class="card text-center-left">
    <div class="card-header">
      <h5 class="proof text-center m-2">Bienvenidos al Jardín de Infantes "Constancio C. Vigil" N° 901</h5>
    </div>
    <div class="card-body">
      <p class="card-text">
        ¡Es un placer darles la bienvenida a nuestro querido <b>Jardín de Infantes "Constancio C. Vigil"</b>! Situado en la encantadora localidad de <b>San Clemente</b>, nuestro jardín es un lugar donde la <b>alegría</b> y el <b>aprendizaje</b> se entrelazan para formar los cimientos sólidos de un <b>futuro brillante</b> para nuestros pequeños.
        <br><br>
        En nuestro jardín, cada día es una aventura llena de <b>descubrimientos emocionantes</b> y <b>experiencias enriquecedoras</b>. Desde el momento en que cruzan nuestras puertas, los niños son recibidos en un entorno <b>cálido</b> y <b>acogedor</b>, diseñado para fomentar su curiosidad natural y estimular su imaginación.
        <br><br>
        Nuestro equipo de educadores <b>altamente dedicados</b> y <b>apasionados</b> está comprometido con el <b>desarrollo integral</b> de cada niño, brindando un enfoque educativo centrado en el juego, la exploración y el afecto. Valoramos la <b>individualidad</b> de cada pequeño y nos esforzamos por nutrir sus talentos únicos mientras cultivamos habilidades <b>sociales</b>, <b>emocionales</b>, <b>cognitivas</b> y <b>físicas</b>.
        <br><br>
        En el <b>Jardín de Infantes "Constancio C. Vigil"</b>, no solo nos preocupamos por el crecimiento académico de nuestros alumnos, sino que también nos esforzamos por crear un ambiente <b>seguro</b> y <b>amoroso</b> donde florezcan <b>amistades duraderas</b> y se construyan <b>recuerdos inolvidables</b>.
        <br><br>
        ¡Estamos emocionados de embarcarnos en este <b>viaje educativo</b> junto a sus hijos y esperamos con ansias cada momento compartido en nuestro <b>amado jardín</b>!
      </p>
    </div>
  </div>
</div>

<div class="notify"> 
<?php
if ($resultado2->num_rows > 0) {
    while ($fila = $resultado2->fetch_assoc()) {
        ?>
        <div class="carter">
            <div class="card text-center-left">
                <div class="card-header">
                    <h5 class="proof text-center m-2">Noticia: <?php echo $fila['Nombre']; ?></h5>
                </div>
                <div class="card-body">
                    <img src="<?php echo $fila['Imagen']; ?>" alt="<?php echo $fila['Nombre']; ?>" class="img-fluid mb-3">
                    <p class="card-text">
                        <?php echo $fila['Descripcion']; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo "No se encontraron noticias.";
}

$conexion->close();
?>
</div>

</div>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
  </script>
  <script src="script.js"></script>
</body>
</html>