<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $conexion = new mysqli("localhost", "root", "", "jardin");

        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        $stmt = $conexion->prepare("DELETE FROM news WHERE ID = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            header("Location: newNew.php");
            exit();
        } else {
            echo "<script>alert('Error al borrar la noticia: " . $stmt->error . "');</script>";
        }

        $stmt->close();
        $conexion->close();
    }
}
?>