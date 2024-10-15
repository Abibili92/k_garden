<?php
$conexion = new mysqli("localhost", "root", "", "jardin");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $inicio = $_POST['Inicio'];
    $fin = $_POST['Fin'];
    $dia = $_POST['Dia'];
    $sala = $_POST['SalaID'];

    // Verificación de campos
    if (!empty($id) && !empty($inicio) && !empty($fin) && !empty($dia) && !empty($sala)) {
        $query = "UPDATE horarios SET Inicio = ?, Fin = ?, Dia = ?, Sala = ? WHERE id = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ssiii", $inicio, $fin, $dia, $sala, $id);

        if ($stmt->execute()) {
            header("Location: newuser.php");
            exit();
        } else {
            echo "Error al actualizar el registro.";
        }

        $stmt->close();
    } else {
        echo "Todos los campos son obligatorios.";
    }
    $conexion->close();
}
?>

