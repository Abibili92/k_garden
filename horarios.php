<?php
$servername = "localhost"; 
$username = "root";
$password = "";
$dbname = "jardin"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$dia = $conn->real_escape_string($_POST['Dia']);
$inicio = $conn->real_escape_string($_POST['Inicio']);
$fin = $conn->real_escape_string($_POST['Fin']);
$sala = $conn->real_escape_string($_POST['SalaID']);

$sql = "INSERT INTO horarios (Dia, Inicio, Fin, Sala) VALUES ('$dia', '$inicio', '$fin', '$sala')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
    alert('Horario añadido exitosamente');
    window.location.href = 'newuser.php'; // Cambia esto por la página a la que quieras redirigir
  </script>";
} else {
    echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
}

$conn->close();
?>